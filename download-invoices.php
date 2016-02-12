<?php
@$session = trim(file_get_contents('session.ini'));

if (!$session) {
    echo 'Please save your session ID inside session.ini. View readme.txt for more info.';
    die(1);
}

mkdir("CNIP - Refunds");
mkdir("IVIP - Sales");
mkdir("IVSF - Fees");
mkdir("IVBF - Buyer Fee");
mkdir("Unknown");

$data = array_map('str_getcsv', file('input.csv'));
$currentRow = 1;
$numberOfRows = count($data);
foreach ($data as $row) {
    $currentRow++;    
    
    $fullId = $row[5];
    if (!$fullId) {
        continue;
    }
    
    $prefix = substr($fullId, 0, 4);
    $id = substr($fullId, 4);
    $url = '';
    
    switch ($prefix) {
        case 'IVIP':
            $url = 'http://codecanyon.net/financial_document/invoices/item_purchases/' . $id;
            $file = 'IVIP - Sales/IVIP' . $id . '.pdf';
            break;
            
        case 'CNIP':
            $url = 'http://codecanyon.net/financial_document/credit_notes/item_purchases/' . $id;
            $file = 'CNIP - Refunds/CNIP' . $id . '.pdf';
            break;
            
        case 'IVBF':
            $url = 'http://codecanyon.net/financial_document/invoices/buyer_fees/' . $id;
            $file = 'IVBF - Buyer Fee/IVBF' . $id . '.pdf';
            break;
            
        default:
            file_put_contents('Unknown/' . $fullId, '');
            continue;
    }
    
    echo "Downloading '$file' (row $currentRow of $numberOfRows)\n";
    $cmd = 'wkhtmltopdf --cookie signed_in 1 --cookie _fd_session ' . escapeshellarg($session) . ' ' . escapeshellarg($url) . ' ' . escapeshellarg($file);
    shell_exec($cmd);
}