<template>
    <div class="layout layout-fluid">
      <div class="page">
        <!-- Navbar -->
        <header class="navbar navbar-expand-md d-print-none">
          <div class="container-xl">
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbar-menu"
              aria-controls="navbar-menu"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
              <a class="content-logo" href="{{ $page.props.auth.user.path  }}">
                <img alt="WCode" class="navbar-brand-image" src="../../img/Logo250x250.svg">
                <img alt="WCode" class="navbar-brand-name" src="../../img/LogoName210x500.svg">
              </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">

              <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu" aria-expanded="false">
                  <span class="avatar avatar-sm rounded" translate="no">{{ getInitials($page.props.auth.user.first_name, $page.props.auth.user.last_name) }}</span>
                              <!-- <span class="avatar avatar-xl mb-3 mb-md-0 rounded">{{ getInitials(props.auth.user.first_name, props.auth.user.last_name) }}</span> -->
                  <div class="d-none d-xl-block ps-2">
                      <div>{{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}</div>
                      <div class="mt-1 small text-muted">{{ $page.props.auth.user.role }}</div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <a href="#" class="dropdown-item">Status</a>
                  <a href="./profile.html" class="dropdown-item">Profile</a>
                  <a href="#" class="dropdown-item">Feedback</a>
                  <div class="dropdown-divider"></div>
                  <Link href="./settings" class="dropdown-item">Configuração</Link>
                  <a href="/logout" class="dropdown-item">Sair</a>
                </div>
              </div>
            </div>
          </div>
        </header>
        <header class="navbar-expand-md">
          <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
              <div class="container-xl">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <Link class="nav-link" :href="`${$page.props.auth.user.path}`">
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="icon"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          stroke-width="2"
                          stroke="currentColor"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M5 12l-2 0l9 -9l9 9l-2 0"/>
                          <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/>
                          <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/>
                        </svg>
                      </span>
                      <span class="nav-link-title">Início</span>
                    </Link>
                  </li>
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#navbar-base"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      role="button"
                      aria-expanded="false"
                    >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="icon icon-tabler icon-tabler-book-2"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          stroke-width="1.5"
                          stroke="currentColor"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12z"/>
                          <path d="M19 16h-12a2 2 0 0 0 -2 2"/>
                          <path d="M9 8h6"/>
                        </svg>
                      </span>
                      <span class="nav-link-title">Cadastro</span>
                    </a>
                    <div class="dropdown-menu">
                      <div class="dropdown-menu-columns">
                        <div class="dropdown-menu-column">
                          <a class="dropdown-item" :href="`${fullPath}user`">Usuário</a>
                          <a class="dropdown-item" href="/register/medic">Médico</a>
                          <a class="dropdown-item" href="./buttons.html">Buttons</a>
                          <div class="dropend">
                            <a
                              class="dropdown-item dropdown-toggle"
                              href="#sidebar-cards"
                              data-bs-toggle="dropdown"
                              data-bs-auto-close="outside"
                              role="button"
                              aria-expanded="false"
                            >
                              Cards
                              <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                            </a>
                            <div class="dropdown-menu">
                              <a href="./cards.html" class="dropdown-item">Sample cards</a>
                              <a href="./card-actions.html" class="dropdown-item">Card actions
                                <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                              </a>
                              <a href="./cards-masonry.html" class="dropdown-item">Cards Masonry</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a
                      class="nav-link dropdown-toggle"
                      href="#navbar-help"
                      data-bs-toggle="dropdown"
                      data-bs-auto-close="outside"
                      role="button"
                      aria-expanded="false"
                    >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="icon"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          stroke-width="2"
                          stroke="currentColor"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
                          <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
                          <path d="M15 15l3.35 3.35"/>
                          <path d="M9 15l-3.35 3.35"/>
                          <path d="M5.65 5.65l3.35 3.35"/>
                          <path d="M18.35 5.65l-3.35 3.35"/>
                        </svg>
                      </span>
                      <span class="nav-link-title">Suporte</span>
                    </a>
                    <div class="dropdown-menu">
                      <a
                        class="dropdown-item"
                        href="https://tabler.io/docs"
                        target="_blank"
                      >
                        Documentation
                      </a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </header>
        <div class="page-wrapper">
              <!-- Flash Message -->
            <FlashMessage class="mt-1"/>

          <!-- Page body -->
          <div class="page-body">
            <div class="container-xl">
              <div class="row row-cards">
                <div class="col-auto g-2 mt-1 d-flex">
                  <!-- Page pre-title -->
                  <PageTitle :pageTitle="titleLayout"/>
                </div>
                <!-- Page content -->
                <slot/>
              </div>
            </div>
          </div>
          <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
              <div class="row text-center align-items-center flex-row-reverse">
                <div class="col-lg-auto ms-lg-auto">
                  <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                      <a href="" target="_blank" class="link-secondary">Documentação</a>
                    </li>
                    <li class="list-inline-item">
                      <a href="./license" class="link-secondary">Licença</a>
                    </li>
                  </ul>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                  <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">Copyright &copy; 2023</li>
                    <li class="list-inline-item">
                      <a href="." class="link-secondary">WCode</a>
                      <span>-</span>
                      <a href="./changelog.html" class="link-secondary" rel="noopener">beta</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </footer>
        </div>
      </div>

    </div>
  </template>
  
  <script setup>
  import PageTitle from "@/Components/PageTitle.vue";
  import { computed } from "vue";
  // import { usePage } from '@inertiajs/inertia-vue3';
  import { Link, usePage } from '@inertiajs/vue3';

  const props = defineProps({
    titleLayout: String,
  });
  
  const page = usePage();
  // const user = page.props.value.auth.user;
  const user = props.auth ? props.auth.user : null;
    
  const fullPath = computed(() => {
    // return `${window.location.origin}${user.path}`;
        return user && user.path ? `${window.location.origin}${user.path}` : '';
  });

  function getInitials(firstName, lastName) {
    // Obtém a primeira letra do primeiro nome e do sobrenome
    const firstInitial = firstName.charAt(0).toUpperCase();
    const lastInitial = lastName.charAt(0).toUpperCase();

    // Junta as iniciais
    return firstInitial + lastInitial;
}
  </script>
  
  <style scoped>
  .dropdown-menu {
    right: 0em !important;
  }
  </style>
  
  