import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailsProduits } from './details-produits';

describe('DetailsProduits', () => {
  let component: DetailsProduits;
  let fixture: ComponentFixture<DetailsProduits>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DetailsProduits],
    }).compileComponents();

    fixture = TestBed.createComponent(DetailsProduits);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
