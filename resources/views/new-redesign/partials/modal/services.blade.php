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

</style>

<script>
// Define services modal functions
window.openServicesModal = function() {
    try {
        // Check if modal is already open (either iframe modal or direct access modal)
        var modal = document.getElementById('servicesModal');
        var appWrapper = document.getElementById('app');
        var isModalOpen = (modal && modal.style.display === 'block') || (appWrapper && appWrapper.style.position === 'fixed');
        
        if (isModalOpen) {
            // If already open, close it
            closeServicesModal();
            return false;
        }
        
        if (!modal) {
            console.error('Services modal not found');
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
        
        // If iframe exists, use it
        var iframe = document.getElementById('servicesModalIframe');
        if (iframe) {
            // Set iframe source
            iframe.src = '/' + locale + '/new-services';
            
            // Show modal
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
            
            // Update services button state
            var servicesBtn = document.getElementById('servicesToggleBtn');
            if (servicesBtn) {
                servicesBtn.classList.add('active');
                var menuIcon = document.getElementById('servicesMenuIcon');
                var closeIcon = document.getElementById('servicesCloseIcon');
                if (menuIcon) menuIcon.style.display = 'none';
                if (closeIcon) closeIcon.style.display = 'flex';
                
                // Update onclick to close modal
                servicesBtn.setAttribute('onclick', 'closeServicesModal(); return false;');
            }
            
            // Listen for messages from iframe to close modal
            window.addEventListener('message', handleServicesModalMessage);
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
                            
                            // Update onclick to close modal
                            servicesBtn.setAttribute('onclick', 'closeServicesModal(); return false;');
                        }
                    })
                    .catch(function(error) {
                        console.error('Error loading services:', error);
                        modalContent.innerHTML = '<div style="padding: 40px; text-align: center;">Ошибка загрузки</div>';
                    });
            }
        }
    } catch (e) {
        console.error('Error opening services modal:', e);
    }
    return false;
};

// Store original function before override
if (!window._originalCloseServicesModal) {
    window._originalCloseServicesModal = window.closeServicesModal;
}

window.closeServicesModal = function() {
    try {
        // First check if we're in direct access mode (appWrapper is fixed)
        var appWrapper = document.getElementById('app');
        // Check both inline style and computed style
        var appPosition = appWrapper ? (appWrapper.style.position || window.getComputedStyle(appWrapper).position) : '';
        var isDirectAccess = appWrapper && appPosition === 'fixed';
        
        console.log('closeServicesModal in services.blade.php: isDirectAccess=', isDirectAccess, 'appPosition=', appPosition);
        
        // Handle direct access mode
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
            }
            
            var pathParts = window.location.pathname.split('/').filter(function(part) {
                return part.length > 0;
            });
            var locale = 'en';
            if (pathParts.length > 0 && ['en', 'ru', 'kz'].includes(pathParts[0])) {
                locale = pathParts[0];
            }
            console.log('Redirecting to:', '/' + locale);
            window.location.href = '/' + locale;
            return false;
        }
        
        // Otherwise handle iframe modal
        var modal = document.getElementById('servicesModal');
        var iframe = document.getElementById('servicesModalIframe');
        var modalContent = document.getElementById('servicesModalContent');
        if (modal) {
            modal.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(function() {
                modal.style.display = 'none';
                modal.style.animation = '';
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
                    
                    // Restore toggle onclick
                    var pathParts = window.location.pathname.split('/').filter(function(part) {
                        return part.length > 0;
                    });
                    var locale = 'en';
                    if (pathParts.length > 0 && ['en', 'ru', 'kz'].includes(pathParts[0])) {
                        locale = pathParts[0];
                    }
                    servicesBtn.setAttribute('onclick', 'if(typeof window.openServicesModal === \'function\') { var modal = document.getElementById(\'servicesModal\'); var appWrapper = document.getElementById(\'app\'); var isModalOpen = (modal && modal.style.display === \'block\') || (appWrapper && appWrapper.style.position === \'fixed\'); if(isModalOpen) { closeServicesModal(); } else { openServicesModal(); } } else { window.location.href = \'/' + locale + '/new-services\'; } return false;');
                }
                
                // Remove message listener
                window.removeEventListener('message', handleServicesModalMessage);
            }, 300);
        }
    } catch (e) {
        console.error('Error closing services modal:', e);
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
    if (e.key === 'Escape') {
        var modal = document.getElementById('servicesModal');
        if (modal && modal.style.display === 'block') {
            closeServicesModal();
        }
    }
});

// Close modal when clicking outside (on backdrop)
document.addEventListener('click', function(e) {
    var modal = document.getElementById('servicesModal');
    if (modal && e.target === modal) {
        closeServicesModal();
    }
});
</script>

