import './bootstrap';
// import 'jspdf'
import { jsPDF } from "jspdf";
import html2canvas from 'html2canvas';
document.getElementById('export-pdf').addEventListener('click', function() {
    // Capturer une image de l'élément contenant le dashboard
    html2canvas(document.getElementById('dashboard'),{scale:5}).then(function(canvas) {
        // Convertir l'image capturée en format base64
        var imgData = canvas.toDataURL('image/jpeg');

        // Créer un objet jsPDF
        var doc = new jsPDF();

        // Ajouter l'image au PDF
        doc.addImage(imgData, 'JPEG', 10, 10,200,287); // Ajuster la taille de l'image selon vos besoins

        // Sauvegarder le PDF
        doc.save('dashboard.pdf');
    });
});
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

