<?php

namespace App\Filament\Manager\Resources\IssueWarningResource\Pages;

use App\Filament\Manager\Resources\IssueWarningResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\IssueWarningLetter;
use App\Models\User;

class CreateIssueWarning extends CreateRecord
{
    protected static string $resource = IssueWarningResource::class;

    protected static bool $canCreateAnother = false;

    public function create(bool $another = false): void
    {
        // Validate the form data
        $data = $this->form->getState();

        // Get the user record by email
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            // Get the manager record by ID
            $manager = Auth::user(); // Assuming the manager is the currently authenticated user
            $departmentName = $manager->department->DepartmentName ?? 'Unknown Department'; // Handle case where department might be null

            try {
                // Send an email with the record data
                Mail::to($user->email)->send(new IssueWarningLetter($user, $manager, $departmentName));
                
                // Display a success message using Filament's notify method
                $this->notify('success', 'Email sent successfully.');
            } catch (\Exception $e) {
                // Display an error message using Filament's notify method
                //$this->notify('danger', 'Failed to send email: ' . $e->getMessage());
            }
        } else {
            // Display a user not found message using Filament's notify method
            $this->notify('danger', 'User not found.');
        }

        // Redirect to the previous page without saving the record
        return;
    }

    public function getTitle(): string
    {
        return 'Issue Warning Letter'; // Change the page title here
    }
}
