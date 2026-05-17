import { Injectable } from '@angular/core';
import { Observable, BehaviorSubject, map, tap } from 'rxjs';
import { User } from './user.model';
import { UserService } from './user.service';

const STORAGE_USER = 'jaayal_user';
const STORAGE_TOKEN = 'jaayal_token';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private readonly currentUserSubject = new BehaviorSubject<User | null>(this.loadUser());
  public readonly currentUser$ = this.currentUserSubject.asObservable();
  public readonly isLoggedIn$ = this.currentUser$.pipe(map((user) => !!user));

  constructor(private readonly userService: UserService) {}

  private loadUser(): User | null {
    const stored = localStorage.getItem(STORAGE_USER);
    return stored ? JSON.parse(stored) as User : null;
  }

  private saveSession(user: User | null, token: string | null): void {
    if (user && token) {
      localStorage.setItem(STORAGE_USER, JSON.stringify(user));
      localStorage.setItem(STORAGE_TOKEN, token);
      this.currentUserSubject.next(user);
      return;
    }

    localStorage.removeItem(STORAGE_USER);
    localStorage.removeItem(STORAGE_TOKEN);
    this.currentUserSubject.next(null);
  }

  get token(): string | null {
    return localStorage.getItem(STORAGE_TOKEN);
  }

  login(email: string, password: string): Observable<User> {
    return this.userService.login(email, password).pipe(
      tap((response) => this.saveSession(response.user, response.token)),
      map((response) => response.user)
    );
  }

  register(payload: { name: string; email: string; password: string; role: string; date_inscription: string }): Observable<User> {
    return this.userService.register(payload);
  }

  logout(): void {
    this.saveSession(null, null);
  }
}
