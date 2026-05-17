import { Component } from '@angular/core';
import { AuthService } from '../../auth.service';
import { Router, RouterLink } from '@angular/router';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.html',
  styleUrls: ['./connexion.css'],
  standalone: true,
  imports: [CommonModule, FormsModule, RouterLink],
})
export class Connexion {
  email = '';
  password = '';
  errorMessage = '';

  constructor(private readonly authService: AuthService, private readonly router: Router) {}

  submit(): void {
    if (!this.email || !this.password) {
      this.errorMessage = 'Email et mot de passe requis.';
      return;
    }

    this.authService.login(this.email, this.password).subscribe({
      next: (user) => {
        if (user.role === 'administrateur') {
          this.router.navigate(['/admin']);
          return;
        }

        if (user.role === 'vendeur') {
          this.router.navigate(['/vendeur']);
          return;
        }

        this.router.navigate(['/public']);
      },
      error: (error) => {
        this.errorMessage =
          error.error?.message ||
          (Array.isArray(error.error?.errors)
            ? Object.values(error.error.errors).flat().join(' ')
            : 'Échec de la connexion.');
      },
    });
  }
}
