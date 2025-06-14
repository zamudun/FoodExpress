@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contact Us</div>
                <div class="card-body">
                    <h4>We'd love to hear from you!</h4>
                    <p>
                        If you have any questions, feedback, or need support, please reach out to us using the information below.
                    </p>
                    <p>
                        <strong>Email:</strong> support@foodie.com.my<br>
                        <strong>Phone:</strong> +60 11 2123 0528<br>
                        <strong>Address:</strong> 123 Foodie Lane, Kuala Lumpur, Malaysia
                    </p>
                    <hr>
                    <form>
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" disabled>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Type your message here" disabled></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" disabled>Send Message</button>
                        <small class="form-text text-muted">Contact form coming soon. Please use the email or phone above for now.</small>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
