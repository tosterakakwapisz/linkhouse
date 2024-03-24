<template>
  <nav class="navbar navbar-expand-sm bg-body-tertiary">
    <div class="container">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <RouterLink to="/app" class="nav-link">Home</RouterLink>
          </li>
          <li>
            <RouterLink to="/app/articles" class="nav-link">
              Articles
            </RouterLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container pt-3">
    <div class="row">
      <div class="col-12">
        <RouterView />
      </div>
    </div>
  </div>
</template>
