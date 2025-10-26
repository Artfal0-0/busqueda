<?php
$this->extend('layouts/main_layout');
$this->section('content');
?>

<div class="container text-center search-container">
    <h1 class="mb-4">Búsqueda Multiagente</h1>
    <form action="/search" method="POST" class="search-form">
        <div class="mb-3">
            <input type="text" name="query" class="form-control form-control-lg search-input" placeholder="Escribe tu consulta..." aria-label="Consulta de búsqueda">
        </div>
        <button class="btn btn-primary btn-lg search-button" type="submit">Buscar</button>
    </form>
</div>
<?php $this->endSection(); ?>