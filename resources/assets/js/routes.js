import VueRouter from 'vue-router'

let routes = [
  {
    path: '/',
    component: require('./page/guest-page').default,
    meta: { middleware: ['guest'] },
    children: [
      {
        name: 'CalerndayEvents',
        path: '/',
        component: require('./page/calendar-events').default
      }
    ]
  }
];

const router = new VueRouter({ 
	mode: 'history', 
	routes: routes 
});

export default router;