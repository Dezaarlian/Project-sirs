<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$users = App\Models\User::select('name','email','role','password')->get();

echo "=== USERS IN DATABASE ===\n";
echo "Total: " . $users->count() . "\n\n";

foreach ($users as $u) {
    $passOk = Illuminate\Support\Facades\Hash::check('password', $u->password) ? '✓ MATCH' : '✗ NO MATCH';
    echo "Name : {$u->name}\n";
    echo "Email: {$u->email}\n";
    echo "Role : {$u->role}\n";
    echo "Pass : $passOk\n";
    echo "---\n";
}
