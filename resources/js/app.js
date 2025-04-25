import './bootstrap';
import { Lucide } from 'lucide';
import { Home, Settings } from 'lucide';

import Alpine from 'alpinejs';

Lucide.createIcons({
    Home,
    Settings
});

window.Alpine = Alpine;

// Direct button click fix
document.addEventListener('DOMContentLoaded', function() {
    // Find all dropdown buttons
    setTimeout(function() {
        const dropdownButtons = document.querySelectorAll('.sm\\:flex button, .relative [x-data] button');
        
        dropdownButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Find the parent dropdown container with Alpine data
                const dropdown = this.closest('[x-data]');
                if (dropdown && dropdown.__x) {
                    // Toggle the dropdown state
                    dropdown.__x.$data.open = !dropdown.__x.$data.open;
                }
            });
        });
    }, 500); // Give Alpine time to initialize
});

Alpine.start();
