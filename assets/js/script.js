function headerMenuMobile() {
  const header = document.getElementById('header')
  const menuBtn = document.querySelector('.mobile-button')
  const menuNav = document.querySelector('.menu-nav-container')

  if (!header || !menuBtn || !menuNav) return

  menuBtn.addEventListener('click', function() {
    header.classList.toggle('menu-open')
  })
}

function toggleLabelShadow(radio) {
  document.querySelectorAll('.colors .radio-label').forEach(function(label) {
    label.classList.remove('shadow-simple-25');
  });
  var parentLabel = radio.closest('.colors .radio-label');
  if (parentLabel) {
    parentLabel.classList.add('shadow-simple-25');
  }
}
function toggleLabelOpacity(radio) {
  document.querySelectorAll('.sizes .radio-label').forEach(function(label) {
    label.classList.add('opacity-50');
  });
  var parentLabel = radio.closest('.sizes .radio-label');
  if (parentLabel) {
    parentLabel.classList.remove('opacity-50');
  }
}

function revealExpositionLocationFilters() {
  var filtersRow = document.querySelectorAll(".region-row");
  if (filtersRow.length) {
    filtersRow.forEach(function (row) {
      var parentButton = row.querySelector(".filter-parent");
      var childrenCol = row.querySelector(".col-right");
      parentButton.addEventListener("click", function () {
        document.querySelectorAll('.region-row .filter-parent.font-black').forEach(function (otherParentButton) {
          if (otherParentButton !== parentButton) {
            otherParentButton.classList.remove("font-black");
          }
        });
        parentButton.classList.toggle("font-black");
        if (!parentButton.classList.contains("no-children")) {
          document.querySelectorAll('.region-row .col-right.region-deployed').forEach(function (otherChildrenCol) {
            if (otherChildrenCol !== childrenCol) {
              otherChildrenCol.classList.remove("!translate-x-0");
              otherChildrenCol.classList.remove("region-deployed");
            }
          });
          childrenCol.classList.toggle("region-deployed");
          childrenCol.classList.toggle("!translate-x-0");
        }
      });
    });
  }
}

function filtersMenuDisplay() {
  var filterToggle = document.getElementById('filters-toggle-menu')
  var filtersContainer = document.getElementById("expositions-filters-container");
  filterToggle.addEventListener("click", function () {
    filtersContainer.classList.toggle("filters-revealed");
    filtersContainer.classList.toggle("filters-hidden");
    filterToggle.classList.toggle('filters-btn-inactive');
    filterToggle.classList.toggle('filters-btn-active');
  })
}

function productTitleRefactor() {
  var productTitles = document.querySelectorAll('.products-grid .variation-item .variation-product-title') || document.querySelector(".product-title");
  productTitles.forEach(function(title) {
    title.textContent = title.textContent.replace(/\s*\(.*?\)\s*/g, '');
  });
}
function productVariatonsRefactor() {
  var variationTexts = document.querySelectorAll('.variations-colors .variations-colors-text');
  variationTexts.forEach(function(textElement) {
    var text = textElement.textContent;
    text = text.replace(/-/g, ' ');
    text = text.split(' ').map(function(word) {
      return word.charAt(0).toUpperCase() + word.slice(1);
    }).join(' ');
    textElement.textContent = text;
  });
}

function variationSelectSystem() {
  var allVariations = JSON.parse(document.querySelector('.variations_form').getAttribute('data-product_variations'));
  function updateVariationId() {
    var selectedColor = document.querySelector('[name="attribute_pa_coloris"]').value;
    var selectedSize = document.querySelector('[name="attribute_pa_dimensions"]').value;
    var matchingVariation = allVariations.find(function(variation) {
      return variation.attributes.attribute_pa_coloris === selectedColor &&
        variation.attributes.attribute_pa_dimensions === selectedSize;
    });

    if (matchingVariation) {
      document.querySelector('input[name="variation_id"]').value = matchingVariation.variation_id;
      var addToCartButton = document.querySelector('button.single_add_to_cart_button');
      if (addToCartButton && addToCartButton.classList.contains('disabled')) {
        addToCartButton.classList.remove('disabled');
      }
    } else {
      document.querySelector('input[name="variation_id"]').value = '';
    }
  }

  function checkAttributesAndRun() {
    var selectedColorRadio = document.querySelector('input.variation-color:checked');
    var selectedSizeRadio = document.querySelector('input.variation-dimension:checked');
    var selectedColor = selectedColorRadio ? selectedColorRadio.value : null;
    var selectedSize = selectedSizeRadio ? selectedSizeRadio.value : null;
    if (selectedColor && selectedSize) {
      updateVariationId();
    }
  }

  document.querySelectorAll('input[type=radio][class=variation-color], input[type=radio][class=variation-dimension]').forEach(function(radio) {
    radio.addEventListener('change', function() {
      console.log(this.value);
      if(this.className === 'variation-color') {
        document.querySelector('[name="attribute_pa_coloris"]').value = this.value;
        toggleLabelShadow(this);
      } else if(this.className === 'variation-dimension') {
        document.querySelector('[name="attribute_pa_dimensions"]').value = this.value;
        toggleLabelOpacity(this)
      }
      checkAttributesAndRun();
    });
  });
}

function numberQuantityInput() {
  document.querySelectorAll('.quantity input[type="number"]').forEach(function(input) {
    var minusSpan = document.createElement('span');
    minusSpan.className = 'minus-arrow';
    input.parentNode.insertBefore(minusSpan, input);
    var plusSpan = document.createElement('span');
    plusSpan.className = 'more-arrow';
    input.parentNode.insertBefore(plusSpan, input.nextSibling);

    minusSpan.addEventListener('click', function() {
      var currentValue = parseInt(input.value, 10) || 0;
      input.value = currentValue - 1;
    });
    plusSpan.addEventListener('click', function() {
      var currentValue = parseInt(input.value, 10) || 0;
      input.value = currentValue + 1;
    });
  });
}

function collaborationsFiltersToggle() {
  const filterButtons = document.querySelectorAll('.collaboration-filter-button');
  const collaborationRows = document.querySelectorAll('.collaboration-row');
  function removeActiveClassesFromRows() {
    collaborationRows.forEach(row => {
      row.classList.remove('collab-revealed');
      row.classList.add('collab-hidden');
    });
  }
  function removeActiveClassesFromButtons() {
    filterButtons.forEach(button => {
      button.classList.remove('collab-active-filter');
    });
  }
  function addActiveClassToRow(slug) {
    const activeRow = document.getElementById(slug);
    if (activeRow) {
      activeRow.classList.add('collab-revealed');
      activeRow.classList.remove('collab-hidden');
    }
  }
  filterButtons.forEach(button => {
    button.addEventListener('click', function() {
      const collaborationSlug = this.getAttribute('data-collaboration');
      removeActiveClassesFromRows();
      removeActiveClassesFromButtons();
      this.classList.add('collab-active-filter');
      addActiveClassToRow(collaborationSlug);
    });
  });
}

document.addEventListener("DOMContentLoaded", function() {
  const body = document.querySelector('body')
  headerMenuMobile()
  if (body.classList.contains('page-template-expositions')) {
    revealExpositionLocationFilters()
    filtersMenuDisplay()
  }
  if (body.classList.contains('tax-product_cat')) {
    productTitleRefactor()
    productVariatonsRefactor()
  }
  if (body.classList.contains('single-product')) {
    productTitleRefactor()
    variationSelectSystem()
    numberQuantityInput()
  }
  if (body.classList.contains('page-template-collaborations')) {
    collaborationsFiltersToggle()
  }
})