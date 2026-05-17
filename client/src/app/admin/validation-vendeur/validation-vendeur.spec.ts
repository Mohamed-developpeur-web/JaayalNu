import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ValidationVendeur } from './validation-vendeur';

describe('ValidationVendeur', () => {
  let component: ValidationVendeur;
  let fixture: ComponentFixture<ValidationVendeur>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ValidationVendeur],
    }).compileComponents();

    fixture = TestBed.createComponent(ValidationVendeur);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
