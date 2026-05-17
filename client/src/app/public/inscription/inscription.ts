import { Component } from '@angular/core';
import { AuthService } from '../../auth.service';
import { Router, RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-inscription',
  templateUrl: './inscription.html',
  styleUrls: ['./inscription.css'],
  standalone: true,
  imports: [CommonModule, FormsModule, RouterLink],
})
export class Inscription {
  name = '';
  email = '';
  password = '';
  role = 'visiteur';
  errorMessage = '';

  constructor(private readonly authService: AuthService, private readonly router: Router) {}

  submit(): void {
    if (!this.name || !this.email || !this.password || !this.role) {
      this.errorMessage = 'Tous les champs sont requis, y compris le rôle.';
      return;
    }

    this.authService
      .register({ name: this.name, email: this.email, password: this.password, role: this.role, date_inscription: new Date().toISOString() })
      .subscribe({
        next: () => this.router.navigate(['/public/connexion']),
        error: (error) => {
          const backendErrors = error.error?.errors
            ? (Object.values(error.error.errors).flat() as unknown[]).filter((message): message is string => !!message)
            : [];

          if (backendErrors.length > 0) {
            this.errorMessage = backendErrors.join(' ');
            return;
          }

          this.errorMessage = error.error?.message
            ? `Échec de l'inscription : ${error.error.message}`
            : 'Échec de l\'inscription. Vérifiez les informations et réessayez.';
        },
      });
  }
}
