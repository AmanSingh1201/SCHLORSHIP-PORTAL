<?php
// Assuming this is your existing login file

// Function to hash a password
function hashPassword($password) {
    // Use the PASSWORD_DEFAULT algorithm, which is currently bcrypt
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $hash;
}

// Function to verify a password
function verifyPassword($password, $hash) {
    // Returns true if the password and hash match
    return password_verify($password, $hash);
}

// Function to encrypt an email (you might want to use a different encryption method)
function encryptEmail($email) {
    // Example: Using base64 encoding
    $encryptedEmail = base64_encode($email);
    return $encryptedEmail;
}

// Function to decrypt an email
function decryptEmail($encryptedEmail) {
    // Example: Using base64 decoding
    $email = base64_decode($encryptedEmail);
    return $email;
}

// Example usage:

// Register user (hash password and encrypt email)
$email = "user@example.com";
$password = "user_password";

$hashedPassword = hashPassword($password);
$encryptedEmail = encryptEmail($email);

// Store $hashedPassword and $encryptedEmail in your database

// Login user (verify password and decrypt email)
$loginEmail = "user@example.com";
$loginPassword = "user_password";

// Retrieve $hashedPassword and $encryptedEmail from your database based on $loginEmail

if (verifyPassword($loginPassword, $hashedPassword)) {
    // Password is correct
    $decryptedEmail = decryptEmail($encryptedEmail);
    echo "Login successful. Decrypted email: $decryptedEmail";
} else {
    // Password is incorrect
    echo "Login failed.";
}
?>