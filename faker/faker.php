<?php

# composer require fzaninotto/Faker
# https://github.com/fzaninotto/Faker

require('vendor/autoload.php');
$faker = Faker\Factory::create('en_PH');

$conn = mysqli_connect("localhost", "ren", "122846", "hrm_functional", 3306);

function faker_employees_unitassignments_has_repairs($conn,$faker,$idmaintenance,$idmaintenance_status): void {
    
    $sql = "SELECT * FROM employees_unitassignments;";
    $query_result = mysqli_query($conn,$sql);
    $rows = mysqli_fetch_all($query_result,MYSQLI_ASSOC);

    $random_row = $faker->numberBetween($min=0,$max=(count($rows)-1));

    $iddepartments = $rows[$random_row]['departments_iddepartments'];
    $idemployees_issued = $rows[$random_row]['employees_idemployees'];    

    if ($idmaintenance_status != 1){
        $sql = "SELECT employees_idemployees FROM service_records WHERE job_positions_idjob_positions in (1214,27,8,19,10262023,202180249);";
        $query_result = mysqli_query($conn,$sql);
        $rows = mysqli_fetch_all($query_result,MYSQLI_ASSOC);
        $idemployees_repairer = $rows[$faker->numberBetween($min=0,$max=(count($rows)-1))]['employees_idemployees'];
    } else {
        $idemployees_repairer = 'null';
    }
    
    $department_floor = $faker->numberBetween($min=1,$max=6);

    $sql = "INSERT INTO employees_unitassignments_has_repairs(`idmaintenance`,`iddepartments`,`idemployees_issued`,`idemployees_repairer`,`department_floor`) 
    VALUES($idmaintenance,$iddepartments,$idemployees_issued,$idemployees_repairer,$department_floor)";

    try{
        mysqli_query($conn,$sql);
    } catch(Exception $e){
        echo $e;
    }
    return;
}

function faker_devices_has_maintenance($conn,$device,$idmaintenance): void {
    $devices_iddevices = $device;
    $maintenance_idmaintenance = $idmaintenance;

    $sql = "INSERT INTO devices_has_maintenance(`devices_iddevices`,`maintenance_idmaintenance`) 
    VALUES($devices_iddevices,$maintenance_idmaintenance)";

    try{
        mysqli_query($conn,$sql);
    } catch(Exception $e){
        echo $e;
    }
    return;
}

function faker_maintenance($conn,$faker): void {
    for($i = 1; $i <= 500; $i++){

        $idmaintenance_status = $faker->numberBetween($min = 1, $max = 4);

        $idmaintenance_type = $faker->numberBetween($min = 1, $max = 2);

        $date_issued = $faker->dateTimeBetween($startDate = '-11 years', $endDate = '-1 years', $timezone = null);

        if ($idmaintenance_status == 1){
            $date_status_change = null;
        } else {
            $date_status_change = $faker->dateTimeBetween($startDate = $date_issued, $endDate = 'now', $timezone = null);
            $date_status_change = $date_status_change->format('Y-m-d H:i:s');           
        }
        
        $date_issued = $date_issued->format('Y-m-d H:i:s');

        $issued_feedback = $faker->text();

        if ($idmaintenance_status == 1 || $idmaintenance_status == 2){
            $repairer_response = '';
        } else {
            $repairer_response = $faker->text();
        }

        $sql = "select * from devices;";
        $device_total = mysqli_query($conn,$sql);

        $device = $faker->numberBetween($min = 1, $max = mysqli_num_rows($device_total));

        if($date_status_change == null){ # lazy way to ignore $date_status_change
            $sql = "INSERT INTO maintenance(`idmaintenance_status`,`idmaintenance_type`,`date_issued`,`issued_feedback`,`repairer_response`,`device`) 
            VALUES($idmaintenance_status, $idmaintenance_type,'".$date_issued."','".$issued_feedback."','".$repairer_response."','".$device."');";
        } else{
            $sql = "INSERT INTO maintenance(`idmaintenance_status`,`idmaintenance_type`,`date_issued`,`date_status_change`,`issued_feedback`,`repairer_response`,`device`) 
            VALUES($idmaintenance_status, $idmaintenance_type,'".$date_issued."','".$date_status_change."','".$issued_feedback."','".$repairer_response."','".$device."');";
        }
        

        try{
            mysqli_query($conn,$sql);
        } catch (Exception $e){
            echo $e;
            return;
        }

        $idmaintenance = mysqli_insert_id($conn); # gets primary id in maintenance table
        
        # sync other tables
        faker_devices_has_maintenance($conn,$device,$idmaintenance);

        faker_employees_unitassignments_has_repairs($conn,$faker,$idmaintenance,$idmaintenance_status);
    }
}

function faker_access($conn,$faker): void { # only gives access to people with related job positions (all of them)
    $sql = "SELECT employees_idemployees FROM service_records WHERE job_positions_idjob_positions in (1214,27,8,19,10262023,202180249);";
    $query_result = mysqli_query($conn,$sql);

    $rows = mysqli_fetch_all($query_result,MYSQLI_ASSOC);

    $sql = "SELECT idemployees FROM employees";
    $query_result2 = mysqli_query($conn,$sql);

    $rows_all = mysqli_fetch_all($query_result2,MYSQLI_ASSOC);

    for($i = 0; $i < mysqli_num_rows($query_result2); $i++){

        $employees_idemployees = $rows_all[$i]['idemployees'];
        $company_email = $faker->email();
        $password = $faker->password();
        

        $website_privilege = null;
        foreach($rows as $x){
            if($rows_all[$i]['idemployees'] == $x['employees_idemployees']){
                $website_privilege = 2;
            }
        }

        if($website_privilege == null){
            $website_privilege = 1;
        }
        
        $sql = "INSERT INTO access(`employees_idemployees`, `company_email`, `password`,`website_privilege`)
        VALUES($employees_idemployees, '".$company_email."', '".$password."',$website_privilege)";

        try{
            mysqli_query($conn,$sql);
        } catch (Exception $e){
            # echo $e;
            # $i--;
        }
    }
}

faker_maintenance($conn,$faker);

# faker_access($conn,$faker); # doesn't work once access table contains something

mysqli_close($conn);