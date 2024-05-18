<!-- resources/views/emails/issue_warning_letter.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Warning Letter</title>
</head>
<body>
    <p>Hello, {{ $user->name }}</p>
    <p>We value your contributions to our company and we understand that everyone may have an off day. However, we've noticed that your attendance record has shown a pattern of lateness and/or absences.</p>
    <p>As per our company policy, employees are expected to maintain a punctuality rate of 90%. According to our records, your current rate of {{ $user->late_percentage }} exceeds the acceptable threshold of 10% lateness or absenteeism.</p>
    <p>We understand there may be circumstances that cause one to be late or absent. If there are any issues that we should be aware of, please feel free to discuss them with us. We are here to support you.</p>
    <p>Please take this as a formal warning and an opportunity to improve. Consistent attendance is important for maintaining productivity and achieving our common goals.</p>
    <p>Thank you for your attention to this matter.</p>
    <p>Best regards,</p>
    <p>{{ $manager->name }}</p>
    <p>Manager of {{ $departmentName }} Department</p>
</body>
</html>
