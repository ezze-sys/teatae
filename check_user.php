<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = User::where('email', 'admin@sinarterang.com')->first();
if ($user) {
    echo "User found: " . $user->name . "\n";
    if (Hash::check('password', $user->password)) {
        echo "Password matches.\n";
    } else {
        echo "Password does NOT match.\n";
    }
} else {
    echo "User NOT found.\n";
}
