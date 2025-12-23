<!-- Services Modal -->
<div id="servicesModal" class="services-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999; background: rgba(0, 0, 0, 0.5); overflow: hidden;">
    <div class="services-modal-content" style="position: relative; width: 100%; height: 100%; background: #ffffff; margin: 0; padding: 0; overflow: hidden;">
        <!-- Iframe for services page (fallback) -->
        <iframe id="servicesModalIframe" src="" style="width: 100%; height: 100%; border: none; display: block; position: absolute; top: 0; left: 0;"></iframe>
        <!-- Content loaded via AJAX (preferred) -->
        <div id="servicesModalContent" style="width: 100%; height: 100%; overflow: auto; position: absolute; top: 0; left: 0; display: none;"></div>
    </div>
</div>

<style>
.services-modal {
    animation: fadeIn 0.3s ease-out;
}

.services-modal-content {
    animation: slideIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideIn {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
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

.services-modal.fade-out {
    animation: fadeOut 0.3s ease-out;
}

</style>

<script>
// Define services modal functions
window.openServicesModal = function() {
    try {
        // Reset closing flag if it was stuck
        if (window._closingServicesModal) {
            window._closingServicesModal = false;
        }
        
        // Get modal element first
        var modal = document.getElementById('servicesModal');
        
        // Use unified function to check if modal is already open
        if (typeof window.isServicesModalOpen === 'function' && window.isServicesModalOpen()) {
            console.log('Modal already open, skipping openServicesModal');
            // Reset flag if it was set
            if (window._servicesModalToggling !== undefined) {
                window._servicesModalToggling = false;
            }
            return false;
        }
        
        if (!modal) {
            console.error('Services modal not found');
            // Reset flag on error
            if (window._servicesModalToggling !== undefined) {
                window._servicesModalToggling = false;
            }
            return false;
        }
        
        // Get current locale from URL
        var pathParts = window.location.pathname.split('/').filter(function(part) {
            return part.length > 0;
        });
        var locale = 'en';
        if (pathParts.length > 0 && ['en', 'ru', 'kz'].includes(pathParts[0])) {
            locale = pathParts[0];
        }
        
        // Keep header exactly as on main page - don't change its styles
        var header = document.querySelector('header.header-redesigned');
        if (header) {
            header.style.display = 'flex';
        }
        
        // Show modal IMMEDIATELY for instant feedback (before iframe loads)
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        
        // If iframe exists, use it
        var iframe = document.getElementById('servicesModalIframe');
        if (iframe) {
            // Set iframe source (will load in background)
            iframe.src = '/' + locale + '/new-services';
            
            // Update services button state
            var servicesBtn = document.getElementById('servicesToggleBtn');
            if (servicesBtn) {
                servicesBtn.classList.add('active');
                var menuIcon = document.getElementById('servicesMenuIcon');
                var closeIcon = document.getElementById('servicesCloseIcon');
                if (menuIcon) menuIcon.style.display = 'none';
                if (closeIcon) closeIcon.style.display = 'flex';
                
                // Keep toggle function - it will detect that modal is open and close it
                servicesBtn.setAttribute('onclick', 'toggleServicesModal(); return false;');
            }
            
            // Listen for messages from iframe to close modal
            window.addEventListener('message', handleServicesModalMessage);
            
            // Reset toggle flag immediately after modal is opened (synchronous operation)
            // This solves problem #1: no delay needed, operation is complete
            if (window._servicesModalToggling !== undefined) {
                // Use requestAnimationFrame to ensure DOM is updated
                requestAnimationFrame(function() {
                    window._servicesModalToggling = false;
                });
            }
        } else {
            // If no iframe, load content via AJAX
            var modalContent = document.getElementById('servicesModalContent');
            if (modalContent) {
                modalContent.innerHTML = '<div style="padding: 40px; text-align: center;">Загрузка...</div>';
                
                // Load content via fetch
                fetch('/' + locale + '/new-services')
                    .then(function(response) {
                        return response.text();
                    })
                    .then(function(html) {
                        // Create a temporary div to parse HTML
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;
                        
                        // Extract content from #app
                        var appContent = tempDiv.querySelector('#app');
                        if (appContent) {
                            modalContent.innerHTML = appContent.innerHTML;
                        } else {
                            modalContent.innerHTML = html;
                        }
                        
                        // Show modal
                        modal.style.display = 'block';
                        document.body.style.overflow = 'hidden';
                        
                        // Keep header exactly as on main page
                        var header = document.querySelector('header.header-redesigned');
                        if (header) {
                            header.style.display = 'flex';
                        }
                        
                        // Update services button state
                        var servicesBtn = document.getElementById('servicesToggleBtn');
                        if (servicesBtn) {
                            servicesBtn.classList.add('active');
                            var menuIcon = document.getElementById('servicesMenuIcon');
                            var closeIcon = document.getElementById('servicesCloseIcon');
                            if (menuIcon) menuIcon.style.display = 'none';
                            if (closeIcon) closeIcon.style.display = 'flex';
                            
                            // Keep toggle function
                            servicesBtn.setAttribute('onclick', 'toggleServicesModal(); return false;');
                        }
                        
                        // Reset toggle flag after modal is opened (synchronous operation)
                        if (window._servicesModalToggling !== undefined) {
                            requestAnimationFrame(function() {
                                window._servicesModalToggling = false;
                            });
                        }
                    })
                    .catch(function(error) {
                        console.error('Error loading services:', error);
                        modalContent.innerHTML = '<div style="padding: 40px; text-align: center;">Ошибка загрузки</div>';
                        // Reset toggle flag on error
                        if (window._servicesModalToggling !== undefined) {
                            window._servicesModalToggling = false;
                        }
                    });
            }
        }
    } catch (e) {
        console.error('Error opening services modal:', e);
        // Reset toggle flag on error
        if (window._servicesModalToggling !== undefined) {
            window._servicesModalToggling = false;
        }
    }
    return false;
};

// Store original function before override
if (!window._originalCloseServicesModal) {
    window._originalCloseServicesModal = window.closeServicesModal;
}

window.closeServicesModal = function() {
    try {
        // Prevent multiple simultaneous close attempts
        if (window._closingServicesModal) {
            console.log('Close already in progress, skipping...');
            return false;
        }
        
        // Use unified function to check if modal is actually open
        if (typeof window.isServicesModalOpen === 'function' && !window.isServicesModalOpen()) {
            console.log('Modal is not open, skipping close');
            // Reset toggle flag if it was set
            if (window._servicesModalToggling !== undefined) {
                window._servicesModalToggling = false;
            }
            return false;
        }
        
        // Set closing flag
        window._closingServicesModal = true;
        
        // Check if we're inside an iframe
        var isInIframe = window.self !== window.top || window.frameElement !== null;
        
        // Use unified function to check modal state
        var appWrapper = document.getElementById('app');
        var appPosition = appWrapper ? (appWrapper.style.position || window.getComputedStyle(appWrapper).position) : '';
        var isDirectAccess = appWrapper && appPosition === 'fixed' && !isInIframe;
        
        console.log('closeServicesModal: isInIframe=', isInIframe, 'isDirectAccess=', isDirectAccess, 'appPosition=', appPosition);
        
        // If we're in iframe, send message to parent to close modal
        if (isInIframe) {
            console.log('Inside iframe, sending message to parent to close modal');
            try {
                window.parent.postMessage('closeServicesModal', '*');
            } catch (e) {
                console.error('Error sending message to parent:', e);
            }
            // Reset flags
            window._closingServicesModal = false;
            if (window._servicesModalToggling !== undefined) {
                window._servicesModalToggling = false;
            }
            return false;
        }
        
        // Handle direct access mode (only if not in iframe)
        if (isDirectAccess) {
            console.log('Direct access detected, handling close...');
            // Handle direct access close
            appWrapper.style.position = '';
            appWrapper.style.top = '';
            appWrapper.style.left = '';
            appWrapper.style.width = '';
            appWrapper.style.height = '';
            appWrapper.style.zIndex = '';
            appWrapper.style.background = '';
            appWrapper.style.overflow = '';
            appWrapper.style.margin = '';
            appWrapper.style.padding = '';
            
            var servicesPage = appWrapper.querySelector('.services-new-page');
            if (servicesPage) {
                servicesPage.style.paddingTop = '';
            }
            
            var footer = document.querySelector('footer, .footer, [class*="footer"]');
            if (footer) footer.style.display = '';
            
            var header = document.querySelector('header.header-redesigned');
            if (header) {
                header.style.display = '';
                header.style.position = '';
                header.style.top = '';
                header.style.zIndex = '';
                header.style.background = '';
            }
            
            document.body.style.overflow = '';
            
            var servicesBtn = document.getElementById('servicesToggleBtn');
            if (servicesBtn) {
                servicesBtn.classList.remove('active');
                var menuIcon = document.getElementById('servicesMenuIcon');
                var closeIcon = document.getElementById('servicesCloseIcon');
                if (menuIcon) menuIcon.style.display = 'flex';
                if (closeIcon) closeIcon.style.display = 'none';
                
                // Restore toggle function
                servicesBtn.setAttribute('onclick', 'toggleServicesModal(); return false;');
            }
            
            var pathParts = window.location.pathname.split('/').filter(function(part) {
                return part.length > 0;
            });
            var locale = 'en';
            if (pathParts.length > 0 && ['en', 'ru', 'kz'].includes(pathParts[0])) {
                locale = pathParts[0];
            }
            console.log('Redirecting to:', '/' + locale);
            // Reset flags before redirect
            window._closingServicesModal = false;
            if (window._servicesModalToggling !== undefined) {
                window._servicesModalToggling = false;
            }
            // Problem #3 solution: Add delay before redirect to allow animation to complete
            setTimeout(function() {
                window.location.href = '/' + locale;
            }, 300); // Match animation duration (300ms from fadeOut)
            return false;
        }
        
        // Otherwise handle iframe modal
        var modal = document.getElementById('servicesModal');
        var iframe = document.getElementById('servicesModalIframe');
        var modalContent = document.getElementById('servicesModalContent');
        
        if (!modal) {
            console.error('Services modal not found');
            window._closingServicesModal = false;
            if (window._servicesModalToggling !== undefined) {
                window._servicesModalToggling = false;
            }
            return false;
        }
        
        // Check if modal is actually visible
        var modalDisplay = modal.style.display || window.getComputedStyle(modal).display;
        if (modalDisplay !== 'block') {
            console.log('Modal is not visible, skipping close');
            window._closingServicesModal = false;
            if (window._servicesModalToggling !== undefined) {
                window._servicesModalToggling = false;
            }
            return false;
        }
        
        // Add fade-out class and animate
        modal.classList.add('fade-out');
        
        setTimeout(function() {
            modal.style.display = 'none';
            modal.classList.remove('fade-out');
            document.body.style.overflow = '';
            
            // Show main content again (if it was hidden)
            if (appWrapper && appWrapper.style.display === 'none') {
                appWrapper.style.display = '';
            }
            
            // Clear iframe source to stop loading
            if (iframe) {
                iframe.src = '';
            }
            
            // Clear modal content if it was loaded via AJAX
            if (modalContent) {
                modalContent.innerHTML = '';
            }
            
            // Restore header - remove any inline styles
            var header = document.querySelector('header.header-redesigned');
            if (header) {
                header.style.display = '';
            }
            
            // Update services button state and restore toggle functionality
            var servicesBtn = document.getElementById('servicesToggleBtn');
            if (servicesBtn) {
                servicesBtn.classList.remove('active');
                var menuIcon = document.getElementById('servicesMenuIcon');
                var closeIcon = document.getElementById('servicesCloseIcon');
                if (menuIcon) menuIcon.style.display = 'flex';
                if (closeIcon) closeIcon.style.display = 'none';
                
                // Restore toggle function
                servicesBtn.setAttribute('onclick', 'toggleServicesModal(); return false;');
            }
            
            // Reset flags after animation completes
            window._closingServicesModal = false;
            if (window._servicesModalToggling !== undefined) {
                window._servicesModalToggling = false;
            }
            
            // Remove message listener
            window.removeEventListener('message', handleServicesModalMessage);
        }, 300); // Animation duration
    } catch (e) {
        console.error('Error closing services modal:', e);
        // Reset flags on error
        window._closingServicesModal = false;
        if (window._servicesModalToggling !== undefined) {
            window._servicesModalToggling = false;
        }
    }
    return false;
};

// Handle messages from iframe
function handleServicesModalMessage(event) {
    // Only accept messages from same origin
    if (event.data === 'closeServicesModal') {
        closeServicesModal();
    }
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.keyCode === 27) {
        // Use unified function to check if modal is open
        if (typeof window.isServicesModalOpen === 'function' && window.isServicesModalOpen()) {
            if (typeof window.closeServicesModal === 'function') {
                window.closeServicesModal();
            }
        }
    }
});

// Close modal when clicking outside (on backdrop)
document.addEventListener('click', function(e) {
    var modal = document.getElementById('servicesModal');
    if (modal && e.target === modal) {
        // Use unified function to check if modal is open
        if (typeof window.isServicesModalOpen === 'function' && window.isServicesModalOpen()) {
            if (typeof window.closeServicesModal === 'function') {
                e.preventDefault();
                e.stopPropagation();
                window.closeServicesModal();
            }
        }
    }
});

// Preload iframe on hover/touch over services button for faster opening
(function() {
    var servicesBtn = document.getElementById('servicesToggleBtn');
    var mobileServicesLink = document.querySelector('a[onclick*="openServicesModal"]');
    var iframe = document.getElementById('servicesModalIframe');
    var preloaded = false;
    
    function preloadIframe() {
        if (!preloaded && iframe && !iframe.src) {
            // Get current locale
            var pathParts = window.location.pathname.split('/').filter(function(part) {
                return part.length > 0;
            });
            var locale = 'en';
            if (pathParts.length > 0 && ['en', 'ru', 'kz'].includes(pathParts[0])) {
                locale = pathParts[0];
            }
            // Preload iframe (hidden, will be shown when modal opens)
            iframe.src = '/' + locale + '/new-services';
            preloaded = true;
        }
    }
    
    if (servicesBtn) {
        // Preload on mouseenter (hover)
        servicesBtn.addEventListener('mouseenter', preloadIframe, { once: true });
        // Also preload on touchstart for mobile
        servicesBtn.addEventListener('touchstart', preloadIframe, { once: true });
    }
    
    // Also preload from mobile menu link
    if (mobileServicesLink) {
        mobileServicesLink.addEventListener('mouseenter', preloadIframe, { once: true });
        mobileServicesLink.addEventListener('touchstart', preloadIframe, { once: true });
    }
})();
</script>

