const textArea = document.getElementById("paste");
const lineNumbersContainer = textArea.parentElement;

function updateLineNumbers() {
  const lines = textArea.value.split("\n");
//   const contentLines = lines.filter(line => line.trim() !== "");

  lineNumbersContainer.querySelectorAll("div").forEach((line, index) => {
    if (index < lines.length) {
      line.textContent = index + 1;
      console.log("hi");
    }
    else {
      line.style.display = "none";
    }
  });

  console.log(textArea.parentElement);
}

textArea.addEventListener("input", updateLineNumbers);

updateLineNumbers();