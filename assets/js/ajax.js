console.log("Ajax loaded");

let currentFilter = '';
let currentRegion = '';
let currentDateFilter = 'upcoming';

function ajaxArtworks(collection = '', page = 1) {
  const loadMoreButton = document.getElementById('load-more-artworks');
  const loader = document.getElementById('loader');
  const artworksList = document.getElementById('artworks-list');

  loader.style.display = 'block';

  let bodyData = 'action=get_artworks&page=' + page;
  if (collection) {
    bodyData += '&collection=' + collection;
  }

  fetch(ajax_object.ajaxurl, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: bodyData
  })
    .then(response => response.text())
    .then(response => {
      loader.style.display = 'none';
      if(page === 1) {
        artworksList.innerHTML = response;
      } else {
        artworksList.insertAdjacentHTML('beforeend', response);
      }
      if(response) {
        loadMoreButton.style.display = 'block';
        loadMoreButton.setAttribute('data-page', parseInt(page) + 1);
      } else {
        loadMoreButton.style.display = 'none';
      }
    })
    .catch(error => {
      console.log('Erreur', error);
      loader.style.display = 'none';
    });
}

function ajaxExpositions(page = 1, region = '', dateFilter = []) {
  const loader = document.getElementById('loader');
  const expositionsList = document.getElementById('expositions-list');

  loader.style.display = 'block';

  let bodyData = 'action=get_expositions&page=' + page;
  if (region) {
    bodyData += '&region=' + region;
  }
  if (dateFilter.length) {
    bodyData += '&date_filter=' + dateFilter.join(',');
  }
  console.log(bodyData);
  fetch(ajax_object.ajaxurl, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: bodyData
  })
    .then(response => response.text())
    .then(response => {
      loader.style.display = 'none';
      expositionsList.innerHTML = response;

      const paginationElement = document.getElementById('exposition-pagination');
      if (paginationElement) {
        paginationElement.addEventListener('click', function(e) {
          if (e.target.classList.contains('pagination-link')) {
            e.preventDefault();
            const selectedPage = e.target.getAttribute('data-page');
            ajaxExpositions(selectedPage, currentRegion, currentDateFilter);
          }
        });
      }
    })
    .catch(error => {
      console.log('Erreur', error);
      loader.style.display = 'none';
    });
}

function ajaxPress(page = 1) {
  const loader = document.getElementById('loader');
  const expositionsList = document.getElementById('press-list');

  loader.style.display = 'block';

  let bodyData = 'action=get_articles-presse&page=' + page;
  console.log(bodyData);
  fetch(ajax_object.ajaxurl, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: bodyData
  })
    .then(response => response.text())
    .then(response => {
      loader.style.display = 'none';
      expositionsList.innerHTML = response;

      const paginationElement = document.getElementById('press-pagination');
      if (paginationElement) {
        paginationElement.addEventListener('click', function(e) {
          if (e.target.classList.contains('pagination-link')) {
            e.preventDefault();
            const selectedPage = e.target.getAttribute('data-page');
            ajaxExpositions(selectedPage, currentRegion, currentDateFilter);
          }
        });
      }
    })
    .catch(error => {
      console.log('Erreur', error);
      loader.style.display = 'none';
    });
}

document.addEventListener("DOMContentLoaded", function() {
  const body = document.querySelector('body')

  if (body.classList.contains('page-template-artworks')) {
    ajaxArtworks();
    document.getElementById('load-more-artworks').addEventListener('click', function() {
      let page = parseInt(this.getAttribute('data-page'));
      ajaxArtworks(currentFilter, page);
    });
    let currentFilter = '';
    const filterButtons = document.querySelectorAll('.filter-button');
    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        filterButtons.forEach(btn => btn.classList.remove('selected'));
        this.classList.add('selected');
        currentFilter = this.getAttribute('data-collection');
        ajaxArtworks(currentFilter, 1);
      });
    });

    document.getElementById('clear-filters').addEventListener('click', function() {
      filterButtons.forEach(button => button.classList.remove('selected'));
      currentFilter = '';
      ajaxArtworks(currentFilter, 1);
    });
  }

  if (body.classList.contains('page-template-expositions')) {
    let currentRegion = '';
    let currentDateFilter = [];
    ajaxExpositions(1, currentRegion, currentDateFilter);
    const periodFilterButtons = document.querySelectorAll('.filter-button[data-filter]');
    periodFilterButtons.forEach(button => {
      button.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');
        const filterIndex = currentDateFilter.indexOf(filter);
        if (filterIndex > -1) {
          currentDateFilter.splice(filterIndex, 1);
          this.classList.add('selected');
        } else {
          currentDateFilter.push(filter);
          this.classList.remove('selected');
        }
        ajaxExpositions(1, currentRegion, currentDateFilter);
      });
    });

    const clearFiltersButton = document.getElementById('clear-filters');
    clearFiltersButton.addEventListener('click', function() {
      const periodFilterButtons = document.querySelectorAll('.filter-button[data-filter]');
      periodFilterButtons.forEach(button => {
        button.classList.remove('selected');
      });
      currentDateFilter = [];
      const regionFilterButtons = document.querySelectorAll('.filter-button[data-region]');
      regionFilterButtons.forEach(button => {
        button.classList.remove('selected');
      });
      currentRegion = '';
      ajaxExpositions(1, currentRegion, currentDateFilter);
    });
    const regionFilterButtons = document.querySelectorAll('.filter-button[data-region]');
    regionFilterButtons.forEach(button => {
      button.addEventListener('click', function() {
        regionFilterButtons.forEach(btn => btn.classList.remove('selected'));
        this.classList.add('selected');
        currentRegion = this.getAttribute('data-region');
        ajaxExpositions(1, currentRegion, currentDateFilter);
      });
    });
  }

  if (body.classList.contains('page-template-presse')) {
    ajaxPress(1)
  }
});