import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('detail-nova-gutenberg', DetailField)
  app.component('form-nova-gutenberg', FormField)
})
