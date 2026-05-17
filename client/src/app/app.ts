// Composant principal racine de l'application Angular.
// Il contient le layout global : menu latéral, barre supérieure et zone de contenu.
// HttpClientModule est importé ici pour permettre aux services d'appeler le backend.
import { Component } from '@angular/core';
import { Router, RouterLink, RouterLinkActive, RouterOutlet } from '@angular/router';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { CommonModule, AsyncPipe, NgIf } from '@angular/common';
import { AuthService } from './auth.service';
import { AuthInterceptor } from './auth.interceptor';
import { FooterComponent } from './footer/footer';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, RouterOutlet, RouterLink, RouterLinkActive, HttpClientModule, NgIf, AsyncPipe, FooterComponent],
  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthInterceptor,
      multi: true,
    },
  ],
  templateUrl: './app.html',
  styleUrls: ['./app.css'],
})
export class App {
  get currentUser$() {
    return this.authService.currentUser$;
  }

  constructor(private readonly authService: AuthService, private readonly router: Router) {}

  logout(): void {
    this.authService.logout();
    this.router.navigate(['/public/connexion']);
  }
}
