import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Category } from './category.model';

@Injectable({
  providedIn: 'root',
})
export class CategoryService {
  private readonly apiUrl = '/api/categories';

  constructor(private readonly http: HttpClient) {}

  list(): Observable<Category[]> {
    return this.http.get<Category[]>(this.apiUrl);
  }

  create(nom: string): Observable<Category> {
    return this.http.post<Category>(this.apiUrl, { nom });
  }
}
