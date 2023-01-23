const btnClose = document.querySelector('.btn-close'); // Vyhledá tlačítko zavřít
const modalOne = document.querySelector('#modal-one'); // Vyhledá modální okno

btnClose.addEventListener('click', function() { // Přidá posluchač události, který poslouchá kliknutí na tlačítko
  modalOne.style.display = 'none'; // Skryje modální okno nastavením stylů na 'none'
});