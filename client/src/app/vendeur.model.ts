export interface Vendeur {
  id: number;
  status_compte: string;
  est_premium: boolean;
  user: {
    id: number;
    name: string;
    email: string;
  };
}
