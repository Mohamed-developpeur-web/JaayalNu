// Commentaire en français : Script d’amorçage JavaScript du projet, chargé de démarrer l'application front-end.
import axios from 'axios';
// Définit axios globalement pour les requêtes HTTP AJAX
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


