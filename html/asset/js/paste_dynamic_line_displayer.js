const textArea = document.getElementById("paste-text");
const lineNumbersContainer = document.querySelector(".line-numbers");

function updateLineNumbers() {
  const lines = textArea.innerHTML.split("\n");
  let lineNumberHTML = "";

  for (let i = 0; i < lines.length; i++) {
    lineNumberHTML += `<div class="line-number">${i + 1}</div>`;
  }

  lineNumbersContainer.innerHTML = lineNumberHTML;
}

updateLineNumbers();