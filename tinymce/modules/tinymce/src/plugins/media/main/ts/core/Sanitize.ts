import Editor from 'tinymce/core/api/Editor';
import AstNode from 'tinymce/core/api/html/Node';

import * as Options from '../api/Options';
import { Parser } from './Parser';

const parseAndSanitize = (editor: Editor, context: string, html: string): AstNode => {
  const validate = Options.shouldFilterHtml(editor);
  return Parser(editor.schema, { validate }).parse(html, { context });
};

export {
  parseAndSanitize
};
