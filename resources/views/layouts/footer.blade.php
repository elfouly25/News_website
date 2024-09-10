<!-- resources/views/footer.blade.php -->
<footer class="text-center mt-4 bg-light py-4" style="background-color: #f8f9fa; color: #343a40;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="mb-0">&copy; {{ date('Y') }} {{ __('message.All rights reserved.') }}</p>
                <div class="social-icons mt-2">
                    <p class="mb-0">Follow us on:</p>
                    <a href="#" class="text-decoration-none mx-2" title="Facebook">
                        <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                    </a>
                    <a href="#" class="text-decoration-none mx-2" title="Twitter">
                        <i class="fab fa-twitter fa-lg" style="color: #1da1f2;"></i>
                    </a>
                    <a href="#" class="text-decoration-none mx-2" title="Instagram">
                        <i class="fab fa-instagram fa-lg" style="color: #c32aa3;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Include Font Awesome for social icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .social-icons a {
    transition: transform 0.3s;
}

.social-icons a:hover {
    transform: scale(1.1); /* Slightly enlarge the icon on hover */
}
    </style>
    