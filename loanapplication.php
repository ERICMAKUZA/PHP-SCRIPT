
<?php
// Read the incoming request payload
echo 'Script Running';
try {
// convert JSON to PHP
$data = json_decode($_REQUEST['rawRequest'], true);

// write data to a file
file_put_contents('webhook_test.txt', print_r($data, true), FILE_APPEND);

} catch (Exception $e) {
    // Log any exceptions or errors
    file_put_contents('error_log.txt', $e->getMessage(), FILE_APPEND);
}

print_r($data);
// Perform actions based on the received data
$formId = $data['formID'];
$submissionId = $data['q109_idNumber'];


// Extract branchname and code

$branchname = '';
$branchcode = '';

foreach ($data as $key => $value) {
    if (strpos($key, 'branchName') !== false && !empty($value)) {
        $branch = $value;
        $parts = explode('-', $branch);
        if (count($parts) > 1) {
            $branchname = trim($parts[0]);
            $branchcode = trim($parts[1]);
        }
        break;
    }
}




// Example: Handle a specific form submission
try {
    // Retrieve form fields
    $nationality = $data['q91_nationality'];
    $forenames = $data['q9_forenames'];
    $surname = $data['q10_surname'];
    $phoneNumber = $data['q138_phoneNumber'];
    $maidenSurname = $data['q12_maidenSurname'];
    $citizenship = $data['q18_email'];
    $idNo = $data['q109_idNumber'];
    $noOfDependants = $data['q14_noOfDependants'];
    $Town = $data['q30_town'];
    $homeTelephone = $data['q139_homeTelephone'];
    $bankName = $data['q163_bankName'];
    $branchName = $branchname;
    $branchCode = $branchcode ;
    $accountName = $data['q22_accountName'];
    $bankaccountno = $data['q24_bankaccountno'];
    $accountType = $data['q26_accountType'];
    $homeType = $data['q27_homeType'][0];
    $streetNumber = $data['q28_streetNumber'];
    $streetName = $data['q29_streetName'];
    $currEmployer = $data['q33_currEmployer'];
    $currEmpPhone = $data['q34_currEmpPhone'];
    $employerContactPerson = $data['q35_employerContactPerson'];
    $currEmpAdd = $data['q36_currEmpAdd'];
    $ecno = $data['q37_ecno'];
    $currEmpPosition = $data['q38_currEmpPosition'];
    $currEmpSalary = $data['q41_currEmpSalary'];
    $currEmpNet = $data['q196_currEmpNet'];
    $nextOfKinRelName = $data['q50_nextOfKinRelName'];
    $nextOfKinRelBustel = $data['q52_nextOfKinRelBustel'];
    $nextOfKinRelReltshp = $data['q51_nextOfKinRelReltshp'];
    $nextOfKinEmployerName = $data['q53_nextOfKinEmployerName'];
    $nextOfKinRelPhone = $data['q57_nextOfKinRelPhone'];
    $nextOfKinRelAdd = $data['q58_nextOfKinRelAdd'];
    $loanPurpose = $data['q102_loanPurpose'][0];
    $disbursementOption = $data['q62_disbursementOption'][0];
    $currBorrowings = $data['q100_currBorrowings'][0];
    $loanAmount = $data['q101_loanAmount'];
    $recomendedLoanAmount = $data['q146_recomendedLoanAmount'];
    $loanInsurance = $data['q148_loanInsurance'];
    $loanTenure=$data['q186_loanTenure'];
    $gender = $data['q6_gender'][0];
    $dob = $data['q205_db']['year'] . '-' . $data['q205_db']['month'] . '-' . $data['q205_db']['day'];
    
    

    // Prepare data for the second POST request
    $postData = [
        'nationality' => $nationality,
        'forenames' => $forenames,
        'surname' => $surname,
        'phoneNumber' => $phoneNumber,
        'maidenSurname' => $maidenSurname,
        'citizenship' => $citizenship,
        'idNo' => $idNo,
        'noOfDependants' => $noOfDependants,
        'Town' => $Town,
        'homeTelephone' => $homeTelephone,
        'bankName' => $bankName,
        'branchName' => $branchName,
        'branchCode' => $branchCode,
        'accountName' => $accountName,
        'bankaccountno' => $bankaccountno,
        'accountType' => $accountType,
        'homeType' => $homeType,
        'streetNumber' => $streetNumber,
        'streetName' => $streetName,
        'currEmployer' => $currEmployer,
        'currEmpPhone' => $currEmpPhone,
        'employerContactPerson' => $employerContactPerson,
        'currEmpAdd' => $currEmpAdd,
        'ecno' => $ecno,
        'currEmpPosition' => $currEmpPosition,
        'currEmpSalary' => $currEmpSalary,
        'currEmpNet' => $currEmpNet,
        'nextOfKinRelName' => $nextOfKinRelName,
        'nextOfKinRelBustel' => $nextOfKinRelBustel,
        'nextOfKinRelReltshp' => $nextOfKinRelReltshp,
        'nextOfKinEmployerName' => $nextOfKinEmployerName,
        'nextOfKinRelPhone' => $nextOfKinRelPhone,
        'nextOfKinRelAdd' => $nextOfKinRelAdd,
        'loanPurpose' => $loanPurpose,
        'disbursementOption' => $disbursementOption,
        'currBorrowings' => $currBorrowings,
        'loanAmount' => $loanAmount,
        'recomendedLoanAmount' => $recomendedLoanAmount,
        'loanInsurance' => $loanInsurance,
        'gender' => $gender,
        'dob' => $dob,
        'loanTenure'=>$loanTenure,

        'empolymentType' => 'permanent',
        'usaCitizenship' => 'no',
        'usaResidentCard' => 'no',
        'postalAddress' => 'string',
        'initials' => 'string',
        'insolvent' => 'no',
        'maritalStatus' => 'string',
        'insolventDetail' => 'string',
        'microfinanceRelated' => 'string',
        'microfinanceRelatedName' => 'string',
        'otherIncomeSources' => 'null',
        'spouseName' => 'string',
        'spouseAddress' => 'string',
        'spouseEmail' => 'string',
        'spouseEmployer' => 'string',
        'spouseEmpAdd' => 'string',
        'civilJudgements' => 'string',
        'sectionCode' => 'kc',
        'guarantorAdd' => 'string',
        'guarantorCity' => 'string',
        'guarantorHomeType' => 'string',
        'guarantorEmployer' => 'string',
        'guarantorEmpAdd' => 'string',
        'createdBy' => 'saltis.staltis',
        'sector' => 'string',
        'loanProductType' => 'Salary Based Loan SSB',
        'emailOwner' => 'me',
        'isChiboque' => 'false',
        'chiboqueLoanID' => '1',
        'savedFrom' => 'string',
        'agent' => 'string',
        'agentReference' => 'Mike',
        'nextofkinrelatioship' => 'string',
        'currEmpEmail' => 'string',
        'monthlySalaryDate' => '2022-09-09',
        'spousePhone' => '345678',
        'nextOfKinRelMoBitel' => 'string',
        'guarantorEmployer' => 'string',
        'guarantorEmployerAdd' => 'string',
        'guarantorEmployerHomeTel' => '34567',
        'timeCurrRes' => '45',
        'timePrevRes' => '87',
        'currency' => 'ZWL',
        'guarantorIdno' => 'string',
        'guarantorPhone' => '12345678',
        'guarantorRent' => '23456.00',
        'guarantorHomeLength' => '56',
        'guarantorEmpLength' => '7',
        'guarantorEmpPhone' => 'string',
        'guarantorEmpEmail' => 'string',
        'guarantorEmpPostn' => 'string',
        'guarantorEmpSalary' => '23456789.00',
        'guarantorEmpIncome' => '23456.00',
        'loanRepayDate' => '2022-07-09',
        'loanApplicationDate' => '2022-07-09',
        'prevBorrowings' => 'string',
        'defaulthistory' => 'no',
        'mainincomesource' => 'string',
        'netincome' => '65349889.00',
        'accountsotherbanks' => 'string',
        'otherpropertyowenership' => 'string',
        'periodinmonths' => '12',
        'RepaymentIntervalNum' => '23',
        'RepaymentUnitInterval' => '1',
        'AdminRate' => '12',
        'loanInterestRate' => '32',
        'refundBank' => 'CBZ',
        'refundBranch' => 'RSF HEAD OFFICE',
        'refundBankAccNo' => '9876543',
        'roleid' => '4041',
        // Add more key-value pairs as needed
    ];
    


// display values in array postData
 
// Store the output of print_r($postData, true) in a variable
$postDataOutput = print_r($postData, true);

// Append the variable to the file
file_put_contents('postdata_test.txt', $postDataOutput, FILE_APPEND);

    // Convert the data to JSON format
    $jsonData = json_encode($postData);

    // Set the request headers
    $headers = [
        'Content-Type: application/json',
    ];

    // Perform the second POST request
    $endpoint = 'http://196.43.97.86/escrow';
    $curl = curl_init($endpoint);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    // Check the response status and handle accordingly
    if ($httpCode === 200) {
        // Successful request, handle the response
        echo 'Second POST request successful. Response: ' . $response;
    } else {
        // Request failed, handle accordingly
        file_put_contents('postfailed_test.txt', print_r($httpCode, true), FILE_APPEND); 
    }

    // Send a response back to the sender (if required)
    http_response_code(200);
    echo 'JotForm webhook received and processed successfully.';
    exit();
}

catch (Exception $e) {
    // Log any exceptions or errors
    file_put_contents('error_log2.txt', $e->getMessage(), FILE_APPEND);
}

// Handle other form submissions or events if needed

// Send a response back to the sender (if required)
http_response_code(200);
echo 'JotForm webhook received.';
?>