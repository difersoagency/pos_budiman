// Pagination
const paginationNumbers = document.getElementById("pagination-numbers");
const paginatedList = document.querySelector(".list-barang");
const listItems = paginatedList.querySelectorAll(".item-table");
const nextButton = document.getElementById("next-btn");
const prevButton = document.getElementById("prev-btn");

const paginationLimit = 2;
const pageCount = Math.ceil(listItems.length / paginationLimit);
let currentPage = 1;

const disableButton = (button) => {
  button.parentElement.classList.add("disabled");
  button.classList.remove("tw-bg-prim-blue");
  button.classList.remove("tw-text-prim-white");
  button.setAttribute("disabled", true);
};

const enableButton = (button) => {
  button.parentElement.classList.remove("disabled");
  button.classList.add("tw-bg-prim-blue");
  button.classList.add("tw-text-prim-white");
  button.removeAttribute("disabled");
};

const handlePageButtonsStatus = () => {
  if (currentPage === 1) {
    disableButton(prevButton);
  } else {
    enableButton(prevButton);
  }

  if (pageCount === currentPage) {
    disableButton(nextButton);
  } else {
    enableButton(nextButton);
  }
};

const handleActivePageNumber = () => {
  document.querySelectorAll(".pagination-number").forEach((button) => {
    button.classList.remove("tw-bg-prim-red");
    const pageIndex = Number(button.getAttribute("page-index"));
    if (pageIndex == currentPage) {
        button.classList.add("tw-bg-prim-red");
    }
  });
};

const appendPageNumber = (index) => {
  const listPage = document.createElement("li");
  const pageNumber = document.createElement("a");
  listPage.className = "page-item"
  pageNumber.className = "pagination-number";
  pageNumber.classList.add("page-link");
  pageNumber.classList.add("tw-text-prim-black");
  pageNumber.innerHTML = index;
  pageNumber.setAttribute("page-index", index);
  pageNumber.setAttribute("aria-label", "Page " + index);
  listPage.appendChild(pageNumber);

  paginationNumbers.appendChild(listPage);
};

const getPaginationNumbers = () => {
  for (let i = 1; i <= pageCount; i++) {
    appendPageNumber(i);
  }
};

const setCurrentPage = (pageNum) => {
  currentPage = pageNum;

  handleActivePageNumber();
  handlePageButtonsStatus();
  
  const prevRange = (pageNum - 1) * paginationLimit;
  const currRange = pageNum * paginationLimit;

  listItems.forEach((item, index) => {
    item.classList.add("tw-hidden");
    if (index >= prevRange && index < currRange) {
      item.classList.remove("tw-hidden");
    }
  });
};

window.addEventListener("load", () => {
  getPaginationNumbers();
  setCurrentPage(1);

  prevButton.addEventListener("click", () => {
    setCurrentPage(currentPage - 1);
  });

  nextButton.addEventListener("click", () => {
    setCurrentPage(currentPage + 1);
  });

  document.querySelectorAll(".pagination-number").forEach((button) => {
    const pageIndex = Number(button.getAttribute("page-index"));

    if (pageIndex) {
      button.addEventListener("click", () => {
        setCurrentPage(pageIndex);
      });
    }
  });
});

// Datepicker
document.querySelector('.input-daterange input').each(function() {
  this.datepicker('clearDates');
});