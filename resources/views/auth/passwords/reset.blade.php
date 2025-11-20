@extends('new.layouts.app')

@section('content')
    <script>
        // Auto-open reset password modal when page loads
        document.addEventListener('DOMContentLoaded', function() {
            var email = '{{ $email ?? old('email') ?? '' }}';
            var token = '{{ $token ?? '' }}';
            
            // Try to get email from URL query parameter if not provided
            if (!email) {
                var urlParams = new URLSearchParams(window.location.search);
                email = urlParams.get('email') || '';
            }
            
            // Try to get token from URL if not provided
            if (!token) {
                var pathParts = window.location.pathname.split('/');
                var tokenIndex = pathParts.indexOf('reset');
                if (tokenIndex !== -1 && pathParts[tokenIndex + 1]) {
                    token = pathParts[tokenIndex + 1];
                }
            }
            
            if (email && token && typeof window.openResetPasswordModal === 'function') {
                setTimeout(function() {
                    window.openResetPasswordModal(email, token);
                }, 500);
            }
        });
    </script>
@endsection
