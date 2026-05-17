import { Injectable } from '@angular/core';
import {
  CanActivate,
  CanActivateChild,
  CanLoad,
  Route,
  Router,
  UrlSegment,
  UrlTree,
  ActivatedRouteSnapshot,
  RouterStateSnapshot,
} from '@angular/router';
import { Observable } from 'rxjs';
import { map, take } from 'rxjs/operators';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root',
})
export class RoleGuard implements CanActivate, CanActivateChild, CanLoad {
  constructor(private readonly authService: AuthService, private readonly router: Router) {}

  private checkRole(expectedRoles?: string[]): Observable<boolean | UrlTree> {
    return this.authService.currentUser$.pipe(
      take(1),
      map((user) => {
        if (!user) {
          return this.router.createUrlTree(['/public/connexion']);
        }

        if (!expectedRoles || expectedRoles.length === 0) {
          return true;
        }

        if (expectedRoles.includes(user.role)) {
          return true;
        }

        if (user.role === 'administrateur') {
          return this.router.createUrlTree(['/admin']);
        }

        if (user.role === 'vendeur') {
          return this.router.createUrlTree(['/vendeur']);
        }

        return this.router.createUrlTree(['/public']);
      })
    );
  }

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean | UrlTree> {
    return this.checkRole(route.data?.['roles'] as string[]);
  }

  canActivateChild(childRoute: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean | UrlTree> {
    return this.checkRole(childRoute.data?.['roles'] as string[]);
  }

  canLoad(route: Route, segments: UrlSegment[]): Observable<boolean | UrlTree> {
    return this.checkRole(route.data?.['roles'] as string[]);
  }
}
