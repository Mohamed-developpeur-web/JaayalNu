import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ProfilVendeur } from './profil-vendeur';

describe('ProfilVendeur', () => {
  let component: ProfilVendeur;
  let fixture: ComponentFixture<ProfilVendeur>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ProfilVendeur],
    }).compileComponents();

    fixture = TestBed.createComponent(ProfilVendeur);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
