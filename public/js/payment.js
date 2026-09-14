const invoiceSelect = document.getElementById("invoice-select");
const summaryCard = document.getElementById("invoice-summary-card");
const amountInput = document.getElementById("amount-input");
const amountHint = document.getElementById("amount-hint");

const rupiah = (value) => "Rp" + Number(value).toLocaleString("id-ID");

function updateInvoiceSummary() {
  const selected = invoiceSelect.options[invoiceSelect.selectedIndex];

  if (!selected || !selected.value) {
    summaryCard.style.display = "none";
    amountHint.textContent = "";
    amountInput.removeAttribute("max");
    return;
  }

  const total = Number(selected.dataset.total || 0);
  const paid = Number(selected.dataset.paid || 0);
  const remaining = Number(selected.dataset.remaining ?? total - paid);
  const isOverpaid = remaining < 0;

  document.getElementById("summary-code").textContent =
    selected.dataset.code || "-";
  document.getElementById("summary-customer").textContent =
    selected.dataset.customer || "-";
  document.getElementById("summary-date").textContent =
    selected.dataset.date || "-";
  document.getElementById("summary-due-date").textContent =
    selected.dataset.dueDate || "-";
  document.getElementById("summary-total").textContent = rupiah(total);
  document.getElementById("summary-paid").textContent = rupiah(paid);

  const remainingEl = document.getElementById("summary-remaining");
  remainingEl.textContent =
    (isOverpaid ? "+" : "") + rupiah(Math.abs(remaining));
  remainingEl.classList.toggle("text-danger", !isOverpaid);
  remainingEl.classList.toggle("text-info", isOverpaid);

  summaryCard.style.display = "";

  if (isOverpaid) {
    amountHint.innerHTML = `<span class="text-danger">This invoice is overpaid by ${rupiah(Math.abs(remaining))}. Reduce or remove other payments before adding a new one.</span>`;
    amountInput.removeAttribute("max");
  } else {
    amountHint.textContent = "Max: " + rupiah(remaining);
    amountInput.setAttribute("max", remaining);
  }
}

const form = amountInput.closest("form");
form.addEventListener("submit", function (e) {
  const selected = invoiceSelect.options[invoiceSelect.selectedIndex];
  if (!selected || !selected.value) return;

  const total = Number(selected.dataset.total || 0);
  const paid = Number(selected.dataset.paid || 0);
  const remaining = Number(selected.dataset.remaining ?? total - paid);
  const amount = Number(amountInput.value || 0);

  if (amount > remaining) {
    e.preventDefault();
    alert(
      "The payment amount (" +
        rupiah(amount) +
        ") exceeds this invoice's remaining balance (" +
        rupiah(Math.max(remaining, 0)) +
        "). Please adjust it.",
    );
    amountInput.focus();
  }
});

invoiceSelect.addEventListener("change", updateInvoiceSummary);
updateInvoiceSummary();

invoiceSelect.addEventListener("change", updateInvoiceSummary);
updateInvoiceSummary();
