import './bootstrap';
import Chart from 'chart.js/auto';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.Chart = Chart;

window.toggleDark = () => {
	document.documentElement.classList.toggle('dark');
	localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
};

if (localStorage.getItem('theme') === 'dark') {
	document.documentElement.classList.add('dark');
}

Alpine.start();
