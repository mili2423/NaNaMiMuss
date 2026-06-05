document.addEventListener("DOMContentLoaded", function () {
    const faqCards = document.querySelectorAll(".faq-card");

    // Lógica del Acordeón Desplegable
    faqCards.forEach((card) => {
        const questionRow = card.querySelector(".faq-question-row");
        const answerContent = card.querySelector(".faq-answer-content");

        questionRow.addEventListener("click", () => {
            const isOpen = card.classList.contains("open");

            // Cerrar todos los demás acordeones antes de abrir uno nuevo
            faqCards.forEach((otherCard) => {
                otherCard.classList.remove("open");
                otherCard.querySelector(".faq-answer-content").style.maxHeight = null;
            });

            // Si no estaba abierto, lo abrimos calculando su altura dinámica
            if (!isOpen) {
                card.classList.add("open");
                answerContent.style.maxHeight = answerContent.scrollHeight + "px";
            }
        });
    });
});

// Función global para filtrar las categorías (Todos, Envíos, etc.)
function filtrarFaq(categoria) {
    // Manejar estado activo en los botones
    const tabs = document.querySelectorAll(".tab-btn");
    tabs.forEach(tab => tab.classList.remove("active"));
    event.target.classList.add("active");

    // Mostrar u ocultar tarjetas basadas en el filtro
    const cards = document.querySelectorAll(".faq-card");
    cards.forEach(card => {
        if (categoria === "todos" || card.getAttribute("data-category") === categoria) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}