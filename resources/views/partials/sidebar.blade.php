<header class="main-nav">
    <div class="sidebar-user text-center">
      <h3 class="h2-90 pt-3 rounded-circle bg-grey ">{{ substr(Auth::user()->first_name, 0, 1) }} {{substr( Auth::user()->last_name,0,1 )}} </h3> 
      <div class="badge-bottom"><span class="badge badge-primary">{{ strtoupper( Auth::user()->role->libelle )}}</span></div>
     {{-- <img class="img-90 rounded-circle" src="../assets/images/dashboard/1.png" alt=""> --}}

      <a href="{{ route('profile.edit') }}">
        <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6> 
      </a>     
      <ul>
        @if (count(Auth::user()->interventions)> 0)
        <li><span>{{ count(Auth::user()->interventions) }}</span> Interventions
        </li>
        @endif
      </ul>
    </div>
    <nav>
      <div class="main-navbar">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="mainnav">           
          <ul class="nav-menu custom-scrollbar">
            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            @php
              $route=request() -> route() -> getName();
            @endphp
            
            <li class="dropdown"><a  @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'dashboard')]) href="{{ route('admin.dashboard') }}"><i data-feather="home"></i><span>Tableau de bord</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'interventions')]) href="{{ route('admin.interventions.index') }}"><span>Interventions</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'consultant')]) href="{{ route('admin.consultant.index') }}"><span>Consultants</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'equipe')]) href="{{ route('admin.equipe.index') }}"><span>Equipes</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'societe')]) href="{{ route('admin.societe.index') }}"><span>Sociétés</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'demandeur')]) href="{{ route('admin.demandeur.index') }}"><span>Demandeurs</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'categorie')]) href="{{ route('admin.categorie.index') }}"><span>Catégories</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'produit')]) href="{{ route('admin.produit.index') }}"><span>Produits</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'chauffeur')]) href="{{ route('admin.chauffeur.index') }}"><span>Chauffeurs</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'faitgenerateur')]) href="{{ route('admin.faitgenerateur.index') }}"><span>Faits Générateurs</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'typedemande')]) href="{{ route('admin.typedemande.index') }}"><span>Types de demande</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'typeintervention')]) href="{{ route('admin.typeintervention.index') }}"><span>Types d'intervention</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'vehicule')]) href="{{ route('admin.vehicule.index') }}"><span>Véhicules</span></a></li>
            <li class="dropdown"><a @class(['nav-link menu-title link-nav','active'=>Str::contains($route, 'role')]) href="{{ route('admin.role.index') }}"><span>Rôles</span></a></li>



          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </div>
    </nav>
  </header>