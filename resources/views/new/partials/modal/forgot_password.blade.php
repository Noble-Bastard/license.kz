<!-- Forgot Password Modal -->
<div id="forgotPasswordModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 999999; width: 100vw; height: 100vh; overflow: auto; background: rgba(0,0,0,0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);" onclick="if(event.target === this) closeForgotPasswordModal();">
    <!-- Modal Content Container - Centered -->
    <div style="display: flex; align-items: center; justify-content: center; min-height: 100%; padding: 20px;">
        <!-- Modal Content -->
        <div style="position: relative; max-width: 500px; width: 100%; margin: auto;" onclick="event.stopPropagation();">
        <!-- Forgot Password Form -->
        <div class="bg-white rounded-lg border shadow-xl relative" style="border-color: #E8E8E8;">
            <!-- Close Button - Top right corner of modal -->
            <button onclick="closeForgotPasswordModal()" style="position: absolute; top: 5px; right: -55px; z-index: 1000000; width: 40px; height: 40px; border-radius: 50%; background-color: #FFFFFF; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.15); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-times" style="color: #191E1D; font-size: 12px; font-weight: 300;"></i>
            </button>
            
            <!-- Title -->
            <div style="padding: 1.5rem 1.5rem 0 1.5rem;">
                <h2 style="color: #191E1D; font-size: 1.5rem; font-weight: 400; text-align: left; margin: 0;">
                    @lang('messages.auth.set_password')
                </h2>
            </div>

            <!-- Form -->
            <div style="padding: 1.5rem;">
                @if (session('status'))
                    <div class="alert alert-success" style="margin-bottom: 1rem; padding: 0.75rem; border-radius: 4px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;">
                        {{ session('status') }}
                    </div>
                @endif

                <form id="forgotPasswordForm" class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label for="forgot_email" style="display: block; color: #191E1D; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem; text-align: left;">
                            Электронная почта
                        </label>
                        <input type="email" 
                               id="forgot_email"
                               name="email" 
                               value="{{ old('email') }}"
                               required
                               autofocus
                               placeholder="example@gmail.com"
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               style="border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;">
                        @if ($errors->has('email'))
                            <span class="help-block invalid-feedback" style="display: block; color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group" style="display: flex; justify-content: flex-start; margin-top: 1.5rem;">
                        <button type="submit"
                                id="forgotPasswordSubmitBtn"
                                class="inline-flex items-center justify-center py-3 text-white font-medium transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                style="background-color: #279760; border-radius: 50px; padding-left: 3rem; padding-right: 3rem;" 
                                onmouseover="this.style.backgroundColor='#1e7a5e'" 
                                onmouseout="this.style.backgroundColor='#279760'">
                            <span id="forgotPasswordBtnText">@lang('messages.auth.send_link')</span>
                            <span id="forgotPasswordBtnLoading" style="display: none;" class="flex items-center">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Загрузка...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>

<style>
    /* Prevent body scroll when modal is open */
    body.modal-open-forgot-password {
        overflow: hidden !important;
    }
    
    /* Placeholder styling */
    #forgotPasswordModal input::placeholder {
        color: rgba(111, 111, 111, 0.6);
    }
    
    /* Smooth animation for modal */
    #forgotPasswordModal {
        animation: fadeIn 0.3s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
    
    /* Ensure modal is visible when opened */
    #forgotPasswordModal[style*="block"] {
        display: block !important;
        z-index: 999999 !important;
        position: fixed !important;
    }
    
    /* Responsive styles for mobile */
    @media (max-width: 768px) {
        #forgotPasswordModal {
            padding: 0 !important;
        }
        
        #forgotPasswordModal > div {
            padding: 0 !important;
            align-items: flex-start !important;
            min-height: 100vh !important;
        }
        
        #forgotPasswordModal > div > div {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
        }
        
        #forgotPasswordModal .bg-white {
            border-radius: 0 !important;
            margin: 0 !important;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        #forgotPasswordModal button[onclick*="closeForgotPasswordModal"] {
            position: fixed !important;
            top: 10px !important;
            right: 10px !important;
            width: 36px !important;
            height: 36px !important;
        }
        
        #forgotPasswordModal h2 {
            font-size: 1.25rem !important;
            padding: 1rem 1rem 0 1rem !important;
        }
        
        #forgotPasswordModal > div > div > div > div[style*="padding: 1.5rem"] {
            padding: 1rem !important;
        }
        
        #forgotPasswordModal button[type="submit"] {
            width: 100% !important;
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }
    }
</style>

<script>
// Forgot Password Modal functions - defined in layout head if not already defined
if (typeof window.openForgotPasswordModal === 'undefined') {
    window.openForgotPasswordModal = function() {
        var modal = document.getElementById('forgotPasswordModal');
        if (modal) {
            // Close login modal if open
            if (typeof window.closeLoginModal === 'function') {
                window.closeLoginModal();
            }
            modal.style.display = 'block';
            document.body.classList.add('modal-open-forgot-password');
            document.body.style.overflow = 'hidden';
        }
    };
}

if (typeof window.closeForgotPasswordModal === 'undefined') {
    window.closeForgotPasswordModal = function() {
        var modal = document.getElementById('forgotPasswordModal');
        if (modal) {
            modal.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(function() {
                modal.style.display = 'none';
                modal.style.animation = '';
                document.body.classList.remove('modal-open-forgot-password');
                document.body.style.overflow = '';
            }, 300);
        }
    };
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (typeof window.closeForgotPasswordModal === 'function') {
            window.closeForgotPasswordModal();
        }
    }
});

// Handle form submission
document.addEventListener('DOMContentLoaded', function() {
    const forgotPasswordForm = document.getElementById('forgotPasswordForm');
    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('forgotPasswordSubmitBtn');
            const btnText = document.getElementById('forgotPasswordBtnText');
            const btnLoading = document.getElementById('forgotPasswordBtnLoading');
            
            if (submitBtn && btnText && btnLoading) {
                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnLoading.style.display = 'flex';
            }
        });
    }
});
</script>

