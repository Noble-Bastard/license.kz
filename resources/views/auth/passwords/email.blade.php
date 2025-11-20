@extends('new.layouts.app')

@section('content')
    <script>
        // Auto-open forgot password modal when page loads
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof window.openForgotPasswordModal === 'function') {
                setTimeout(function() {
                    window.openForgotPasswordModal();
                }, 500);
            }
        });
    </script>
@endsection
