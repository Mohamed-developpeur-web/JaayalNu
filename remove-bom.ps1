$phpFiles = Get-ChildItem -Path 'c:\xampp\htdocs\Certification-PHP\Jaayal' -Recurse -Filter '*.php'
foreach ($file in $phpFiles) {
    $bytes = [System.IO.File]::ReadAllBytes($file.FullName)
    if ($bytes.Length -ge 3 -and $bytes[0] -eq 0xEF -and $bytes[1] -eq 0xBB -and $bytes[2] -eq 0xBF) {
        Write-Output "Removing BOM from: $($file.FullName)"
        [System.IO.File]::WriteAllBytes($file.FullName, $bytes[3..($bytes.Length - 1)])
    }
}
