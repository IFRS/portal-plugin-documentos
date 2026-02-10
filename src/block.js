import { registerBlockType } from '@wordpress/blocks';
import {
  useBlockProps,
  InspectorControls,
  RichText,
  InnerBlocks
} from '@wordpress/block-editor';
import {
  PanelBody,
  TextControl,
} from '@wordpress/components';

registerBlockType('ifrs/ultimos-documentos', {
  title: 'Últimos Documentos',
  description: 'Bloco para exibir os últimos documentos cadastrados ou atualizados.',
  icon: 'text-page',
  category: 'widgets',

  attributes: {
    title: { type: 'string', default: 'Últimos Documentos' },
    postsPerPage: { type: 'number', default: 5 },
  },

  edit({ attributes, setAttributes }) {
    const { title, postsPerPage } = attributes;
    const blockProps = useBlockProps();

    // Dados mockados para o editor
    const mockDocuments = [
      {
        id: 1,
        date: '28/12/2009',
        time: '09h30',
        types: ['Comunicado'],
        title: 'Comunicado importante'
      },
      {
        id: 2,
        date: '29/12/2009',
        time: '10h15',
        types: ['Portaria', 'Resolução'],
        title: 'Resolução sobre novos procedimentos'
      },
      {
        id: 3,
        date: '30/12/2009',
        time: '16h45',
        types: ['Ofício'],
        title: 'Ofício circular para todos os campi'
      },
    ];

    return (
      <>
        <InspectorControls>
          <PanelBody title="Configurações" initialOpen={true}>
            <TextControl
              label="Título do Bloco"
              value={title}
              onChange={(value) => setAttributes({ title: value })}
            />
            <TextControl
              label="Quantidade de Documentos"
              type="number"
              value={postsPerPage}
              onChange={(value) => setAttributes({ postsPerPage: parseInt(value) })}
              min="1"
              max="50"
            />
          </PanelBody>
        </InspectorControls>

        <div {...blockProps}>
          <div className="ultimos-documentos">
            <RichText
              tagName="h2"
              className="ultimos-documentos__title"
              value={title}
              onChange={(value) => setAttributes({ title: value })}
              placeholder="Insira o título"
              allowedFormats={[]}
            />
            {mockDocuments.slice(0, postsPerPage).map((doc) => (
              <a key={doc.id} href="#" className="documento-recente">
                <div className="documento-recente__meta">
                  <p class="documento-recente__datetime">
                    {doc.date}
                    &agrave;s
                    {doc.time}
                  </p>

                  &bull;
                  <ul className="documento-recente__taxonomy-list">
                    {doc.types.map((type, idx) => (
                      <li key={idx}>{type}</li>
                    ))}
                  </ul>
                </div>
                <h3 className="documento-recente__title">
                  {doc.title}
                </h3>
              </a>
            ))}
          </div>

          <InnerBlocks
            allowedBlocks={['core/buttons']}
            template={[['core/buttons', { layout: { type: 'flex', justifyContent: 'center' } }, [['core/button', { className: 'is-style-outline', text: 'Acesse todos os Documentos' }]]]]}
            templateLock="insert"
          />
        </div>
      </>
    );
  },

  save() {
    return null; // Renderizado no servidor
  },
});
