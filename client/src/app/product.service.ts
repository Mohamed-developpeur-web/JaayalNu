// Service Angular chargé de communiquer avec le backend Laravel.
// Il utilise HttpClient pour appeler l'API REST et retourne un Observable.
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Product } from './product.model';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  // Endpoint API dans Angular : le proxy redirige /api vers le backend Laravel.
  private readonly apiUrl = '/api/produits';

  constructor(private readonly http: HttpClient) {}

  // Récupère la liste des produits depuis l'API.
  list(): Observable<Product[]> {
    return this.http.get<Product[]>(this.apiUrl);
  }

  // Récupère un produit par son identifiant.
  get(id: number): Observable<Product> {
    return this.http.get<Product>(`${this.apiUrl}/${id}`);
  }
}
