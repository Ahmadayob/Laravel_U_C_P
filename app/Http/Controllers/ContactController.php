<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index()
    {
        return view('contact', ['pageTitle' => 'Contact Us']);
    }

    /**
     * Handle the contact form submission.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Here you would typically:
        // 1. Send an email to your support team
        // 2. Store the message in a database
        // 3. Send a confirmation email to the user

        // For now, we'll just redirect back with a success message
        // You can implement email sending using Laravel's Mail facade

        // Example: Mail::to('support@example.com')->send(new ContactFormMail($validated));

        return redirect()->back()->with('success', 'Thank you for your message! We\'ll get back to you soon.');
    }
}
