<!-- Login Modal -->
<div id="loginModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 999999; width: 100vw; height: 100vh; overflow: auto; background: rgba(0,0,0,0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);" onclick="if(event.target === this) closeLoginModal();">
    <!-- Modal Content Container - Centered -->
    <div style="display: flex; align-items: center; justify-content: center; min-height: 100%; padding: 20px;">
        <!-- Modal Content -->
        <div style="position: relative; max-width: 500px; width: 100%; margin: auto;" onclick="event.stopPropagation();">
        <!-- Login Form -->
        <div class="bg-white rounded-lg border shadow-xl relative" style="border-color: #E8E8E8;">
            <!-- Close Button - Top right corner of modal -->
            <button onclick="closeLoginModal()" style="position: absolute; top: 5px; right: -55px; z-index: 1000000; width: 40px; height: 40px; border-radius: 50%; background-color: #FFFFFF; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.15); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-times" style="color: #191E1D; font-size: 12px; font-weight: 300;"></i>
            </button>
            
            <!-- Tabs -->
            <div style="display: flex; padding: 1.5rem 1.5rem 0 1.5rem; gap: 2rem;">
                <button type="button" 
                        id="loginTab" 
                        onclick="switchTab('login')"
                        class="transition-colors"
                        style="color: #191E1D; font-size: 1.5rem; font-weight: 400; padding-bottom: 1rem; text-align: left;">
                    Вход
                </button>
                <button type="button" 
                        id="registerTab" 
                        onclick="switchTab('register')"
                        class="transition-colors"
                        style="color: #6F6F6F; font-size: 1.5rem; font-weight: 400; padding-bottom: 1rem; text-align: left;">
            Регистрация
                </button>
        </div>

            <!-- Login Form -->
            <div id="loginFormContainer" style="padding: 1.5rem;">
            <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

                @php
                    $request = request()->create(redirect()->intended()->getTargetUrl());
                    $locale = app('laravellocalization')->getCurrentLocale() != 'ru' ? app('laravellocalization')->getCurrentLocale() : '';
                    $pathWithLocale = $request->getRequestUri();
                    if(substr($request->getRequestUri(), 1, 2) !== $locale){
                        $pathWithLocale = $locale . $request->getRequestUri();
                    }
                    session()->put('url.intended', $pathWithLocale);
                @endphp

                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <!-- Login Fields -->
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: #191E1D;">
                                Электронная почта
                            </label>
                            <input type="email" 
                                   name="email" 
                                   required 
                                   autofocus
                                   value="{{ old('email') }}"
                                   placeholder="example@gmail.com"
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                   style="border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;">
            </div>

                        <div>
                            <label class="block text-sm font-medium mb-2" style="color: #191E1D;">
                                Пароль
                            </label>
                            <input type="password" 
                                   name="password" 
                                   required
                                   placeholder="Введите пароль"
                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                                   style="border-color: #D9D9D9; color: #191E1D; background-color: #FFFFFF;">
                        </div>
                    </div>

                    <!-- Submit Button and Forgot Password -->
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem;">
                        <button type="submit" 
                                id="loginSubmitBtn"
                                class="inline-flex items-center justify-center py-3 text-white font-medium transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                style="background-color: #279760; border-radius: 50px; padding-left: 3rem; padding-right: 3rem;" onmouseover="this.style.backgroundColor='#1e7a5e'" onmouseout="this.style.backgroundColor='#279760'">
                            <span id="loginBtnText">Войти</span>
                            <span id="loginBtnLoading" style="display: none;" class="flex items-center">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Загрузка...
                                  </span>
                        </button>
                        @if (Route::has('password.request'))
                        <a href="javascript:void(0)" onclick="if(typeof window.openForgotPasswordModal === 'function') { window.openForgotPasswordModal(); } else { window.location.href='{{ route('password.request') }}'; } return false;" class="text-sm transition-colors" style="color: #191E1D; cursor: pointer;" onmouseover="this.style.color='#000'" onmouseout="this.style.color='#191E1D'">
                            Забыли пароль?
                        </a>
              @endif
            </div>
            </div>
          </form>
        </div>
            
            <!-- Register Form Container (hidden by default) -->
            <div id="registerFormContainer" style="display: none; padding: 1.5rem;">
                <!-- Person Type Selection -->
                <div style="margin-bottom: 1.5rem;">
                    <p style="color: #191E1D; font-size: 0.875rem; margin-bottom: 0.75rem; text-align: left;">
                        Выберите статус
                    </p>
                    <div style="display: flex; gap: 0.75rem; margin-bottom: 1.5rem; justify-content: flex-start; align-items: center;">
                        <button type="button" 
                                id="legalTab" 
                                onclick="switchPersonType('legal')"
                                class="transition-colors whitespace-nowrap"
                                style="color: #191E1D; background-color: #FFFFFF; border: 1px solid #E8E8E8; border-radius: 25px; padding: 0.5rem 1.5rem; font-size: 1rem; font-weight: 400;">
              @lang('messages.all.entity')
                        </button>
                        <button type="button" 
                                id="individualTab" 
                                onclick="switchPersonType('individual')"
                                class="transition-colors whitespace-nowrap"
                                style="color: #FFFFFF; background-color: #279760; border: 1px solid #279760; border-radius: 25px; padding: 0.5rem 1.5rem; font-size: 1rem; font-weight: 400;">
              @lang('messages.all.individual')
                        </button>
                    </div>
          </div>

                <!-- Individual Registration Form -->
                <div id="individualFormContainer">
                    @php
                        $registerError = $errors ?? new \Illuminate\Support\MessageBag();
                    @endphp
          @include('new.partials.modal.register_individal')
                </div>
                
                <!-- Legal Registration Form -->
                <div id="legalFormContainer" style="display: none;">
                    @php
                        $autoFocus = false;
                        $profileLegal = new \App\Data\Core\Model\ProfileExt();
                    @endphp
                    @include('new.partials.modal.register_legal', ["isNewProfile" => true, 'autoFocus' => $autoFocus, "profileLegal" => $profileLegal])
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<style>
    /* Override global CSS that hides registration forms */
    #registerFormContainer form.new_modal_login_main_tab_pane_register {
        display: flex !important;
        flex-direction: column;
    }
    
    /* Prevent body scroll when modal is open */
    body.modal-open {
        overflow: hidden !important;
    }
    
    /* Ensure modal is visible when opened */
    #loginModal[style*="flex"] {
        display: flex !important;
        z-index: 99999 !important;
        position: fixed !important;
    }
    
    #loginModal {
        z-index: 99999 !important;
    }
    
    /* Responsive styles for mobile */
    @media (max-width: 768px) {
        #loginModal {
            padding: 0 !important;
            align-items: flex-end !important;
            justify-content: flex-end !important;
        }
        
        #loginModal > div {
            padding: 0 !important;
            align-items: flex-end !important;
            justify-content: flex-end !important;
            min-height: 100vh !important;
            width: 100% !important;
        }
        
        #loginModal > div > div {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            max-height: 50vh !important;
            display: flex !important;
            flex-direction: column !important;
        }
        
        /* Registration form takes more space */
        #loginModal > div > div.register-mode {
            max-height: 70vh !important;
        }
        
        #loginModal .bg-white {
            border-radius: 8px 8px 0 0 !important;
            margin: 0 !important;
            max-height: 50vh !important;
            min-height: auto !important;
            height: auto !important;
            display: flex;
            flex-direction: column;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Registration form container visible - increase height */
        #loginModal .bg-white.register-mode {
            max-height: 70vh !important;
        }
        
        #loginModal button[onclick*="closeLoginModal"] {
            position: absolute !important;
            top: 10px !important;
            right: 10px !important;
            width: 36px !important;
            height: 36px !important;
            z-index: 10 !important;
        }
        
        #loginModal button[type="button"][id="loginTab"],
        #loginModal button[type="button"][id="registerTab"] {
            font-size: 1.25rem !important;
            padding: 1rem 1rem 0.75rem 1rem !important;
        }
        
        /* Status buttons (legalTab, individualTab) - keep desktop style, just scale down */
        #loginModal button[type="button"][id="legalTab"],
        #loginModal button[type="button"][id="individualTab"] {
            font-size: 0.875rem !important;
            padding: 0.4rem 1.25rem !important;
            border-radius: 25px !important;
        }
        
        #loginModal > div > div > div > div[id*="FormContainer"],
        #loginModal > div > div > div > div > div[style*="padding: 1.5rem"] {
            padding: 1rem !important;
        }
        
        #loginModal button[type="submit"] {
            width: 100% !important;
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }
        
        #loginModal > div > div > div > div > div > div[style*="display: flex"][style*="justify-content: space-between"] {
            flex-direction: column !important;
            gap: 1rem !important;
            align-items: flex-start !important;
        }
        
        #loginModal > div > div > div > div > div > div[style*="display: flex"][style*="justify-content: space-between"] > a {
            text-align: left !important;
            width: 100% !important;
        }
    }
    
    /* Smooth animation for modal */
    #loginModal {
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
    
    #loginModal > div:last-child {
        animation: slideUp 0.3s ease-out;
    }
    
    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    /* Mobile slide up animation from bottom */
    @media (max-width: 768px) {
        #loginModal > div > div {
            animation: slideUpFromBottom 0.3s ease-out !important;
        }
        
        @keyframes slideUpFromBottom {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
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
    
    /* Placeholder styling */
    #loginModal input::placeholder {
        color: rgba(111, 111, 111, 0.6);
    }
</style>

<script>
// Modal functions - override if not already defined in layout
if (typeof window.openLoginModal === 'undefined') {
    window.openLoginModal = function() {
        var modal = document.getElementById('loginModal');
        if (modal) {
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
            document.body.style.overflow = 'hidden';
        }
    };
}

if (typeof window.closeLoginModal === 'undefined' || !window.closeLoginModal.toString().includes('setTimeout')) {
    window.closeLoginModal = function() {
        var modal = document.getElementById('loginModal');
        if (modal) {
            modal.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(function() {
                modal.style.display = 'none';
                modal.style.animation = '';
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
            }, 300);
        }
    };
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        if (typeof window.closeLoginModal === 'function') {
            window.closeLoginModal();
        }
    }
});

// Prevent modal from closing when clicking inside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('loginModal');
    if (modal) {
        const modalContent = modal.querySelector('.relative.z-10');
        if (modalContent) {
            modalContent.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    }
    
    // Handle form submission
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('loginSubmitBtn');
            const btnText = document.getElementById('loginBtnText');
            const btnLoading = document.getElementById('loginBtnLoading');
            
            if (submitBtn && btnText && btnLoading) {
                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnLoading.style.display = 'flex';
            }
        });
    }
    
    // Handle custom checkbox click for is_resident
    // Use event delegation on document to catch all clicks
    document.addEventListener('click', function(e) {
        // Check if clicked on custom-checkbox
        if (e.target.classList.contains('custom-checkbox')) {
            e.preventDefault();
            e.stopPropagation();
            // Find the input checkbox - it's the previous sibling in the DOM
            const input = e.target.previousElementSibling;
            if (input && input.type === 'checkbox') {
                input.checked = !input.checked;
                
                // Manually update custom checkbox styles
                const customCheckbox = e.target;
                if (input.checked) {
                    customCheckbox.style.backgroundColor = '#279760';
                    customCheckbox.style.borderColor = '#279760';
                    // Add checkmark via pseudo-element by ensuring CSS applies
                    customCheckbox.setAttribute('data-checked', 'true');
                } else {
                    customCheckbox.style.backgroundColor = '#FFFFFF';
                    customCheckbox.style.borderColor = '#D9D9D9';
                    customCheckbox.removeAttribute('data-checked');
                }
                
                // Trigger change event to update CSS styles
                const changeEvent = new Event('change', { bubbles: true });
                input.dispatchEvent(changeEvent);
            }
        }
    }, true);
    
    // Make functions globally available
    window.openLoginModal = openLoginModal;
    window.closeLoginModal = closeLoginModal;
});

// Tab switching function
function switchTab(tab) {
    const loginTab = document.getElementById('loginTab');
    const registerTab = document.getElementById('registerTab');
    const loginFormContainer = document.getElementById('loginFormContainer');
    const registerFormContainer = document.getElementById('registerFormContainer');
    const modalContent = document.querySelector('#loginModal > div > div');
    const modalWhite = document.querySelector('#loginModal .bg-white');
    
    if (tab === 'login') {
        // Activate login tab
        loginTab.style.color = '#191E1D';
        registerTab.style.color = '#6F6F6F';
        
        // Show login form
        loginFormContainer.style.display = 'block';
        registerFormContainer.style.display = 'none';
        
        // Remove register mode class for mobile (50vh)
        if (modalContent) {
            modalContent.classList.remove('register-mode');
        }
        if (modalWhite) {
            modalWhite.classList.remove('register-mode');
        }
    } else {
        // Activate register tab
        registerTab.style.color = '#191E1D';
        loginTab.style.color = '#6F6F6F';
        
        // Show register form
        registerFormContainer.style.display = 'block';
        loginFormContainer.style.display = 'none';
        
        // Ensure individual form is visible by default
        const individualFormContainer = document.getElementById('individualFormContainer');
        const legalFormContainer = document.getElementById('legalFormContainer');
        if (individualFormContainer && legalFormContainer) {
            individualFormContainer.style.display = 'block';
            legalFormContainer.style.display = 'none';
            // Add active class to individual form
            const individualForm = individualFormContainer.querySelector('form.new_modal_login_main_tab_pane_register');
            if (individualForm) {
                individualForm.classList.add('active');
            }
            // Remove active class from legal form
            const legalForm = legalFormContainer.querySelector('form.new_modal_login_main_tab_pane_register');
            if (legalForm) {
                legalForm.classList.remove('active');
            }
        }
        
        // Reset person type tabs to default (individual active)
        const individualTab = document.getElementById('individualTab');
        const legalTab = document.getElementById('legalTab');
        if (individualTab && legalTab) {
            individualTab.style.color = '#FFFFFF';
            individualTab.style.backgroundColor = '#279760';
            individualTab.style.borderColor = '#279760';
            legalTab.style.color = '#191E1D';
            legalTab.style.backgroundColor = '#FFFFFF';
            legalTab.style.borderColor = '#E8E8E8';
        }
        
        // Add register mode class for mobile (70vh)
        if (modalContent) {
            modalContent.classList.add('register-mode');
        }
        if (modalWhite) {
            modalWhite.classList.add('register-mode');
        }
    }
}

// Make switchTab globally available
window.switchTab = switchTab;

// Person type switching function
function switchPersonType(type) {
    const individualTab = document.getElementById('individualTab');
    const legalTab = document.getElementById('legalTab');
    const individualFormContainer = document.getElementById('individualFormContainer');
    const legalFormContainer = document.getElementById('legalFormContainer');
    
    if (!individualTab || !legalTab || !individualFormContainer || !legalFormContainer) {
        console.error('Form elements not found');
        return;
    }
    
    if (type === 'individual') {
        // Activate individual tab
        individualTab.style.color = '#FFFFFF';
        individualTab.style.backgroundColor = '#279760';
        individualTab.style.borderColor = '#279760';
        legalTab.style.color = '#191E1D';
        legalTab.style.backgroundColor = '#FFFFFF';
        legalTab.style.borderColor = '#E8E8E8';
        
        // Show individual form
        if (individualFormContainer) {
            individualFormContainer.style.display = 'block';
            // Also add active class to form inside
            const individualForm = individualFormContainer.querySelector('form.new_modal_login_main_tab_pane_register');
            if (individualForm) {
                individualForm.classList.add('active');
            }
        }
        if (legalFormContainer) {
            legalFormContainer.style.display = 'none';
            // Remove active class from form inside
            const legalForm = legalFormContainer.querySelector('form.new_modal_login_main_tab_pane_register');
            if (legalForm) {
                legalForm.classList.remove('active');
            }
        }
    } else if (type === 'legal') {
        // Activate legal tab
        legalTab.style.color = '#FFFFFF';
        legalTab.style.backgroundColor = '#279760';
        legalTab.style.borderColor = '#279760';
        individualTab.style.color = '#191E1D';
        individualTab.style.backgroundColor = '#FFFFFF';
        individualTab.style.borderColor = '#E8E8E8';
        
        // Show legal form
        if (legalFormContainer) {
            legalFormContainer.style.display = 'block';
            // Also add active class to form inside
            const legalForm = legalFormContainer.querySelector('form.new_modal_login_main_tab_pane_register');
            if (legalForm) {
                legalForm.classList.add('active');
            }
        }
        if (individualFormContainer) {
            individualFormContainer.style.display = 'none';
            // Remove active class from form inside
            const individualForm = individualFormContainer.querySelector('form.new_modal_login_main_tab_pane_register');
            if (individualForm) {
                individualForm.classList.remove('active');
            }
        }
    }
}

// Make switchPersonType globally available
window.switchPersonType = switchPersonType;
</script>
