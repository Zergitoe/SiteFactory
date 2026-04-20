# La Table de Margaux

Site web professionnel genere par **Site Factory** le 2026-04-20.

## Informations

- **Client** : La Table de Margaux
- **Secteur** : Restaurant gastronomique, cuisine francaise contemporaine
- **Style** : luxe-premium
- **Domaine cible** : latabledemargaux.fr
- **Slug** : `la-table-de-margaux`
- **Mot-cle principal** : restaurant gastronomique Bordeaux
- **Ville** : Bordeaux

## Structure des fichiers

```
la-table-de-margaux/
├── index.html          # Page d'accueil
├── contact.html        # Page contact (et autres pages...)
├── robots.txt          # Instructions pour les crawlers
├── sitemap.xml         # Plan du site pour Google
├── favicon.svg         # Icone onglet navigateur
├── site.webmanifest    # Manifest PWA
├── .htaccess           # Config Apache (cache, gzip, HTTPS)
├── vercel.json         # Config deploy Vercel (clean URLs)
├── package.json        # Pour detection Vercel
├── images/             # Images du site
└── README.md           # Ce fichier
```

Chaque page HTML est autonome avec son propre `<head>` SEO (title, meta description, canonical, OG tags).
Vercel sert automatiquement `/contact` depuis `contact.html` grace a `cleanUrls: true`.

## Deploiement Vercel (recommande)

1. [vercel.com/new](https://vercel.com/new) -> Import Git Repository
2. Selectionne ce repo
3. **Root Directory** : `clients/la-table-de-margaux`
4. **Framework Preset** : Other
5. **Build Command** : (laisser vide)
6. **Output Directory** : `.`
7. Deploy

Apres le deploiement :
- Settings -> Domains -> ajoute `latabledemargaux.fr` et `www.latabledemargaux.fr`
- Configure les DNS chez le registrar (Vercel donne les instructions)

## Deploiement hebergeur classique (OVH, O2Switch, etc.)

1. Upload tout le contenu du dossier via FTP dans le `www/` ou `public_html/`
2. Le fichier `.htaccess` active automatiquement : cache, gzip, HTTPS redirect
3. Verifie que mod_rewrite est active

## Checklist post-lancement SEO

- [ ] **Google Search Console** : ajouter le site et soumettre le sitemap
  https://search.google.com/search-console
- [ ] **Google Business Profile** : creer / revendiquer la fiche
  https://business.google.com
- [ ] **Google Analytics 4** : ajouter le tracking dans `index.html`
- [ ] **Bing Webmaster Tools** : soumettre le sitemap
- [ ] **Test Rich Results** : valider les Schema.org
  https://search.google.com/test/rich-results
- [ ] **PageSpeed Insights** : verifier le score Core Web Vitals
  https://pagespeed.web.dev
- [ ] **Annuaire locaux** : PagesJaunes, Yelp, Tripadvisor si pertinent
- [ ] **Avis clients** : activer les demandes d'avis Google

## Modifications courantes

### Changer un texte
Ouvre `index.html` dans un editeur (VS Code, Sublime, Notepad++).
Utilise Ctrl+F pour trouver le texte a remplacer.

### Changer une couleur
Les couleurs sont dans les variables CSS en haut du `<style>` :
```css
:root {
  --primary: #xxxxxx;
  --secondary: #xxxxxx;
  --accent: #xxxxxx;
}
```

### Changer le numero de telephone
Ctrl+F sur l'ancien numero dans `index.html`, remplace partout.
Verifie aussi les `tel:` dans les `href` et le Schema.org JSON-LD.

### Ajouter une image
1. Upload l'image dans le dossier (idealement en WebP compresse)
2. Remplace le `src` ou `background-image` correspondant
3. Garde les attributs `loading="lazy"` et `alt="..."`

## Support technique

Pour toute revision complexe, contacte-moi directement.

---
*Genere avec Site Factory v2*
