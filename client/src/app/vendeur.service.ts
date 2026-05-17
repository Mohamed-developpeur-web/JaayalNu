import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Vendeur } from './vendeur.model';

@Injectable({
  providedIn: 'root',
})
export class VendeurService {
  private readonly apiUrl = '/api/vendeurs';

  constructor(private readonly http: HttpClient) {}

  list(): Observable<Vendeur[]> {
    return this.http.get<Vendeur[]>(this.apiUrl);
  }

  get(id: number): Observable<Vendeur> {
    return this.http.get<Vendeur>(`${this.apiUrl}/${id}`);
  }
}
