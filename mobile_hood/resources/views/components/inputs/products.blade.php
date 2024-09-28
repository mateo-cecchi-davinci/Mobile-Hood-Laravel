<form id="searchForm" class="d-flex align-items-center rounded-1 border bg-white" style="max-width: 520px;">
    <input type="hidden" name="buisness" id="buisnessId" value="{{ $buisness['id'] }}">
    <input type="text" id="searchInput" name="query" class="search-input border-0 rounded-start-1 w-100 ps-2"
        placeholder="Buscar productos...">
    <div class="search-btn-container bg-white rounded-end-1">
        <button class="sm-search-btn text-light border-0 mt-2 me-2">
            <i class="bx bx-search"></i>
        </button>
    </div>
</form>
