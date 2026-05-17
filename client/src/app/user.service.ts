import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { User } from './user.model';

export interface LoginResponse {
  user: User;
  token: string;
}

@Injectable({
  providedIn: 'root',
})
export class UserService {
  private readonly apiUrl = '/api/users';

  constructor(private readonly http: HttpClient) {}

  register(payload: {
    name: string;
    email: string;
    password: string;
    role: string;
    date_inscription: string;
  }): Observable<User> {
    return this.http.post<User>(this.apiUrl, payload);
  }

  login(email: string, password: string): Observable<LoginResponse> {
    return this.http.post<LoginResponse>('/api/login', { email, password });
  }
}
