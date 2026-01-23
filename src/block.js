import { registerBlockType } from '@wordpress/blocks';
import {
  useBlockProps,
  InspectorControls
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
        date: '22/01/2026',
        time: '14h30',
        types: ['Comunicado'],
        title: 'Comunicado importante',
        link: '#'
      },
      {
        id: 2,
        date: '21/01/2026',
        time: '10h15',
        types: ['Portaria', 'Resolução'],
        title: 'Resolução sobre novos procedimentos',
        link: '#'
      },
      {
        id: 3,
        date: '20/01/2026',
        time: '16h45',
        types: ['Ofício'],
        title: 'Ofício circular para todos os campi',
        link: '#'
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
            {title && (
              <h2 className="ultimos-documentos__title">{title}</h2>
            )}
            {mockDocuments.slice(0, postsPerPage).map((doc) => (
              <div key={doc.id} className="ultimos-documentos__documento">
                <p className="ultimos-documentos__documento-datetime">
                  {doc.date}
                  &agrave;s
                  {doc.time}
                </p>
                &bull;
                <ul className="ultimos-documentos__documento-types">
                  {doc.types.map((type, idx) => (
                    <li key={idx}>{type}</li>
                  ))}
                </ul>
                <h3 className="ultimos-documentos__documento-title">
                  <a href={doc.link}>{doc.title}</a>
                </h3>
              </div>
            ))}
          </div>

          <div className="acesso-todos-documentos">
            <hr className="acesso-todos-documentos__separador" />
            <a href="#" className="acesso-todos-documentos__link">
              Acesse todos os Documentos
            </a>
          </div>
        </div>
      </>
    );
  },

  save() {
    return null; // Renderizado no servidor
  },
});
