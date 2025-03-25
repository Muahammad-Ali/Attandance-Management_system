import './bootstrap';
import { Lucide } from 'lucide';
import { Home, Settings } from 'lucide';

import Alpine from 'alpinejs';

Lucide.createIcons({
    Home,
    Settings
});

window.Alpine = Alpine;

Alpine.start();
