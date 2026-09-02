const itemSelect = document.getElementById("item_id");
const unitPriceInput = document.getElementById("unit_price");
const unitPriceDisplay = document.getElementById("unit_price_display");

function formatRupiah(number) {
  return "Rp" + Number(number).toLocaleString("id-ID");
}

function fillUnitPrice() {
  if (!itemSelect || !unitPriceInput) return;
  const selectedOption = itemSelect.options[itemSelect.selectedIndex];
  const price = selectedOption ? selectedOption.dataset.price || "0" : "0";

  unitPriceInput.value = price;
  if (unitPriceDisplay) {
    unitPriceDisplay.textContent = formatRupiah(price);
  }
}

if (itemSelect && unitPriceInput) {
  itemSelect.addEventListener("change", fillUnitPrice);

  // fill on load in case an item is pre-selected (e.g. after validation error, or on edit page)
  if (itemSelect.value) {
    fillUnitPrice();
  }
}

document
  .getElementById("itemDetailForm")
  .addEventListener("submit", function (e) {
    let valid = true;

    const quantity = document.getElementById("quantity");
    const unitPrice = document.getElementById("unit_price");
    const unitPriceBox = document.getElementById("unit_price_box");

    const quantityError = document.getElementById("quantityError");
    const unitPriceError = document.getElementById("unitPriceError");

    quantity.classList.remove("is-invalid");
    if (unitPriceBox) unitPriceBox.classList.remove("border-danger");
    if (unitPriceError) unitPriceError.classList.remove("d-block");

    quantityError.textContent = "";
    if (unitPriceError) unitPriceError.textContent = "";

    if (Number(quantity.value) < 1) {
      quantityError.textContent = "The minimum quantity is 1.";
      quantity.classList.add("is-invalid");
      valid = false;
    } else if (Number(unitPrice.value) < 1) {
      if (unitPriceError) {
        unitPriceError.textContent = "Please select an item first.";
        unitPriceError.classList.add("d-block");
      }
      if (unitPriceBox) unitPriceBox.classList.add("border-danger");
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });
