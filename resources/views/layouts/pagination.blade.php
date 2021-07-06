 <!-- Pagination -->
<nav aria-label="Page navigation justify-content-center">
    <ul class="pagination justify-content-center mx-auto">
        <li class="page-item">
            {!! $posts->links("pagination::bootstrap-4") !!}
        </li>
    </ul>
</nav>